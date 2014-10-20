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

    protected $languageCode;
    protected $region;
    protected $campaignName;
    public $validLang = FALSE;
    
    
    public $dealsData = NULL;
    public $langData = [];
    public $menuData = NULL;
    
    //document names
    protected $dealsDocName;
    protected $langDocName;
    protected $menuDocName;

    public function init() {
        
        //initialize couchbase document names
        $this->initDocNames();
        //set the document data
        $this->initBuckets();
    }
    
    public function initBuckets() {
        $this->loadCouchDeals();
        $this->loadCouchLanguage();
        $this->loadCouchMenu();
    }

    public function initDocNames() {
        //initialize couchbase document name
        $this->dealsDocName = "merch:deal:" . md5(strtolower($this->campaignName)) . ":" . $this->languageCode; //'merch:deal:89d921405d671b155f4a5eaa595bf1ed:de_DE';
        $this->langDocName  = "merch:lang:" . md5('lang-' . $this->languageCode) . ":" . $this->languageCode;
        $this->menuDocName  = "merch:menu:" . md5('site-menu');
    }


    public function loadCouchDeals() {
        try {           
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get($this->dealsDocName);
            if(!empty($var))
                $this->dealsData = json_decode ($var, TRUE);
            
        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }        
        return FALSE;
    }
    
    public function loadCouchLanguage() {
         try {            
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get($this->langDocName);
            if(!empty($var))
                $this->langData = json_decode ($var, TRUE);
            
        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }        
        return FALSE;
    }
    
    public function loadCouchMenu() {
         try {            
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var = $Couch->get($this->menuDocName);
            if(!empty($var))
                $this->menuData = json_decode ($var);  
            
        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }        
        return FALSE;
    }  
    
    /**
     * Load the campaign data
     * @return bool|array
     */
    public function loadCampaignData() {
        try {
            return $this->dealsData['campaign'];
            
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
            return $this->dealsData['deals'];

        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }
        return FALSE;
    }

    public function getBanner($campaign) {
        try {            
            if (key_exists($campaign, $this->dealsData['banner'])) {
                return $this->dealsData['banner'][$campaign];
            } else {
                return array_shift($this->dealsData['banner']);
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return FALSE;
    }
    
    /**
     * To get all hotels inside the city
     * 
     * @param type $region
     * @param type $country
     * @param type $city
     * @return type array
     */
    public function getCityHoteles($region, $country, $city) {
        $data = [];
        if (isset($this->dealsData['campaign'][$region][$country][$city])){
            foreach ($this->dealsData['campaign'][$region][$country][$city] as $key => $val) {
                if ($key != 'name' && $key != 'sort') {
                   
                    $data[$key] = $val;
                }
            }           
        }     
        return $data;
    }
    
    public function getCountryHoteles($region, $country) {
        return $this->getDefaultHoteles();
    }
    
    public function getRegionHoteles($region) {
        return $this->getDefaultHoteles();
    }

    public function getDefaultHoteles() {
        $data = [];
        foreach ($this->dealsData['campaign'] as $key => $val) {
            if ($key != 'name' && $key != 'sort') {
               foreach ($val as $k => $v) {
                    if ($k != 'name' && $k != 'sort') {                       
                        foreach ($v as $k1 => $v1) {
                            if ($k1 != 'name' && $k1 != 'sort') {      
                                foreach($v1 as $k2 => $v2) {
                                    if ($k2 != 'name' && $k2 != 'sort') {     
                                       $data[$k2] = $v2;
                                    }
                                }                                                                 
                            }
                        }                         
                    }
                }
            }
        }
        return $data;
    }    

    public function isLanguageExists() {
        if (!empty($this->langData))
            return TRUE;
       
        return FALSE;
    }
    public function isValidDefaultCampaign() {
        
        $this->dealsDocName = "merch:deal:" . md5(strtolower(self::DEFAULT_PAGE_CAMPAIGN)) . ":" . self::DEFAULT_PAGE_LANG;
        $this->loadCouchDeals();
        if ($this->dealsData == NULL)
            return FALSE;
        
        return TRUE;
    }


    public function setDefaultLang() {
        try {
            $this->langDocName  = "merch:lang:" . md5('lang-' . self::DEFAULT_PAGE_LANG) . ":" . self::DEFAULT_PAGE_LANG;
            $this->loadCouchLanguage();
            if (!empty($this->langData))
                return TRUE;
            
            return FALSE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $this->session->set('languageCode', self::DEFAULT_PAGE_LANG);
    }
    
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
