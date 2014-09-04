<?php

/**
 *
 * @package    Page.php
 * @author     Rakesh Shrestha
 * @since      27/11/13 5:17 PM
 * @version    1.0
 * @Updated	   Ravi
 */

namespace HC\Merch\Models;

use Phalcon\Exception;

class Page extends \Phalcon\Mvc\Model {

    const DEFAULT_PAGE_CAMPAIGN = 'Summer-Escape';
    const DEFAULT_PAGE_REGION = 'Pacific';
    const DEFAULT_PAGE_LANG = 'en_AU';
    const DEFAULT_PAGE_LAYOUT = 'main';    

    protected $campaignFilePath;
    protected $bannerFilePath;
    protected $hotelFilePath;
    protected $data;
    protected $languageCode;
    protected $region;
    protected $campaignName;
    protected $langFilePath;

    public function initialize() {
        $this->langFilePath = __dir__ . '/../language/';
    }
    
    public function getData() {
        if (null === $this->data) {
            $this->data['hotels'] = $this->loadHotelData();
        }
        return $this->data;
    }

    /**
     * Get only region data from campaing
     * @param String $region
     * return array
     */
    public function getDataByRegion($region) {
        if (is_array($this->loadCampaignData())) {
            if (array_key_exists($region, $this->loadCampaignData())) {
                return $this->loadCampaignData()[$region];
            }
        }
        return FALSE;
    }

    public function getDefaultHoteles() {
        $data = [];        
        foreach ($this->loadCampaignData() as $key => $val) {
            if ($key != 'name' && $key != 'sort') {
                foreach ($val as $k => $v) {
                    if ($k != 'name' && $k != 'sort') {                       
                        foreach ($v as $k1 => $v1) {
                            if ($k1 != 'name' && $k1 != 'sort') {                       
                                $data[key($v1['deals'])] = $v1['deals'][key($v1['deals'])];                                 
                            }
                        }                         
                    }
                }
            }
        }        
        return $data;
    }

    public function getCampaignDefaultHotels() {
        $data = [];        
        foreach ($this->loadCampaignData() as $key => $val) {
            if ($key != 'name' && $key != 'sort') {
                foreach ($val as $k => $v) {
                    if ($k != 'name' && $k != 'sort') {                       
                        foreach ($v as $k1 => $v1) {
                            if ($k1 != 'name' && $k1 != 'sort') {                       
                                $data[key($v1['deals'])] = $v1['deals'][key($v1['deals'])];                                 
                            }
                        }                         
                    }
                }
            }
        }        
        return $data;
    }

    public function getRegionDefaultHotels($region) {

        $data = [];
        foreach ($this->getDataByRegion($region) as $key => $val) {
            if ($key != 'name' && $key != 'sort') {
                foreach ($val as $k => $v) {
                    if ($k != 'name' && $k != 'sort') {
                        $data[key($v['deals'])] = $v['deals'][key($v['deals'])];
                    }
                }
            }
        }
        return $data;
    }

    public function getCountryDefaultHotels($region, $country) {
        $data = [];
        foreach ($this->getDataByRegion($region)[$country] as $key => $val) {
            if ($key != 'name' && $key != 'sort') {
                $data[key($val['deals'])] = $val['deals'][key($val['deals'])];
            }
        }
        return $data;
    }

    public function getHotelsByCity($region, $country, $city) {
        $data = [];
        foreach ($this->getDataByRegion($region)[$country][$city] as $key => $val) {
            return $this->getDataByRegion($region)[$country][$city]['deals'];
        }
        return $data;
    }

    /**
     * Load the campaign data
     * @return bool|array
     */
    public function loadCampaignData() {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get(md5(strtolower($this->campaignName)).':'.$this->languageCode.':campaign');
            if (!empty($var))
                return json_decode($var, TRUE);

        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }
        return FALSE;
    }

    /**
     * Default flag is TRUE -> if primary data is not exists then, it will load default data
     * 
     * @param boolean $defaultFlag
     * @return array | boolean
     */
    public function loadBannerData($defaultFlag = FALSE) {

        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get(md5(strtolower($this->campaignName)).':'.$this->languageCode.':banner');
            if (!empty($var))
                return json_decode($var, TRUE);

            if ($defaultFlag == TRUE) {
                $varDefault = $Couch->get(md5(strtolower(self::DEFAULT_PAGE_CAMPAIGN)).':'.self::DEFAULT_PAGE_LANG.':banner');
                if (!empty($varDefault))
                    return json_decode($varDefault, TRUE);
            }

        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }
        return FALSE;

    }

    /**
     * Load the hotel deals
     * @return bool|array
     */

    public function loadHotelData() {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get(md5(strtolower($this->campaignName)).':'.$this->languageCode.':deals');
            if (!empty($var))
                return json_decode($var, TRUE);

        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }
        return FALSE;
    }

    public function getBanner($region) {
        $bannerData = $this->loadBannerData(TRUE);
        if (is_array($bannerData)) {
            if (array_key_exists($region, $bannerData)) {
                return $bannerData[$region];
            }
            return $this->loadBannerData(TRUE)[self::DEFAULT_PAGE_REGION];
        }
        return FALSE;
    }

    protected function getCurrentTab() {
        if (!(empty($this->data['tabs']))) {
            if ($this->menuTabMain === null && $this->menuTabSub === null) {
                return "Australia";
            }
            if ($this->menuTabSub == null && !empty($this->menuTabMain)) {
                return $this->menuTabMain;
            }
            if ($this->menuTabSub != null && !empty($this->menuTabSub)) {
                return $this->menuTabSub;
            }
            //return $this->menuTabSub;
        }
    }
    
    public function isLanguageFileExists() {
        if (file_exists($this->langFilePath . $this->languageCode . '.php'))
            return TRUE;
        else
            return FALSE;
    }

    /* @todo refactor this logic 
      protected function getCurrentTab()
      { //echo "<pre>"; print_r($this->menuTabSub);
      if (!(empty($this->data['tabs']))) {
      if ($this->menuTabMain === null && $this->menuTabSub === null) {
      return $this->menuTabMain;
      }
      if ($this->menuTabSub === null && !empty($this->data['tabs'][$this->menuTabMain])) {
      // return $this->data['tabs'][$this->menuTabMain];
      return $this->menuTabMain;
      }
      if ($this->menuTabSub !== null && !empty($this->data['tabs'][$this->menuTabSub])) {
      //return $this->data['tabs'][$this->menuTabSub];
      return $this->menuTabSub;

      }
      }
      }
     */

    /**
     * 
     * @param String $region
     * @return \HC\Merch\Models\Page
     */
    public function setRegion($region) {
        $this->region = $region;
        return $this;
    }

    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode) {
        $this->languageCode = $languageCode;
        return $this;
    }

    /**
     * @param mixed $campaignName
     */
    public function setCampaignName($campaignName) {
        $this->campaignName = $campaignName;
        return $this;
    }

    /**
     * @param mixed $menuTabMain
     */
    public function setMenuTabMain($menuTabMain) {
        $this->menuTabMain = $menuTabMain;
        return $this;
    }

    /**
     * @param mixed $menuTabSub
     */
    public function setMenuTabSub($menuTabSub) {
        $this->menuTabSub = $menuTabSub;
        return $this;
    }

    public function getConnectionService() {
        
    }

    public function setForceExists($bool = true) {
        
    }

    public function dumpResult($var, $foo) {
        
    }

    public function getConnection() {
        
    }

}
