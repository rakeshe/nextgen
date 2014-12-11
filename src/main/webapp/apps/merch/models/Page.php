<?php

/**
 *
 * @package    Page.php
 * @author     Rakesh Shrestha
 * @since      27/11/13 5:17 PM
 * @version    1.0
 * @Updated       Ravi
 */

namespace HC\Merch\Models;

use Phalcon\Exception;

class Page extends \Phalcon\Mvc\Model
{

    const APP_DOC_NAME = ":merch:deals";
    const DEFAULT_PAGE_CAMPAIGN = 'worldonsale';
    const DEFAULT_PAGE_REGION = 'Pacific';
    const DEFAULT_PAGE_LANG = 'en_AU';
    const DEFAULT_PAGE_LAYOUT = 'geo-map';
    const DEFAULT_PAGE_CURRENCY = 'AUD';
    const FILE_CACHE_PATH = '/../../../data/';

    protected $campaignName;
    protected $campaignThumbnail;
    protected $city;
    protected $country;
    protected $countryCode;
    protected $currency;
    protected $languageCode;
    protected $layout;
    protected $region;
    public $validLang = false;
    public $appData = null;
    public $dealsData = null;
    public $langData = [];
    public $menuData = null;
    //document names
    public $dealsDocName;
    protected $langDocName;
    protected $menuDocName;
    public $urlDocName;
    protected $setPageUrl;
    public $pageUrlData;

    public function init()
    {
        //initialize couchbase document names
        $this->initDocNames();
        //set the document data
        $this->initBuckets();
    }

    public function initBuckets()
    {
        $this->loadCouchAppData();
        $this->loadCouchDeals();
        $this->loadCouchPageDeals();
        $this->loadCouchLanguage();
        $this->loadCouchMenu();
    }

    public function setPageUrl($url)
    {
        $this->setPageUrl = $url;
        return $this;
    }

    public function initDocNames()
    {
        //initialize couchbase document name..
        $this->dealsDocName = ORBITZ_ENV . ":merch:deals:" . md5(strtolower($this->campaignName) . '/') . ":" . $this->languageCode;
        //'merch:deal:89d921405d671b155f4a5eaa595bf1ed:de_DE';
        $this->langDocName  = ORBITZ_ENV . ":merch:lang:" . md5('lang-' . $this->languageCode) . ":" . $this->languageCode;
       // $this->menuDocName  = ORBITZ_ENV . ":merch:menu:" . md5('site-menu');
        $this->menuDocName  = "merch:menu:" . md5('site-menu');
        $this->urlDocName = ORBITZ_ENV . ":merch:deals:" . md5($this->setPageUrl);
    }

    protected function loadCouchAppData()
    {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get(ORBITZ_ENV . self::APP_DOC_NAME);
            $var = empty($var) ? $this->getFileData(ORBITZ_ENV .':' . self::APP_DOC_NAME) : $var;
            if (!empty($var)) {
                $this->appData = json_decode($var, true);
                $this->storeToFile(ORBITZ_ENV . self::APP_DOC_NAME, $this->appData);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function loadCouchDeals()
    {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get($this->dealsDocName);
            $var = empty($var) ? $this->getFileData($this->dealsDocName) : $var;
            if (!empty($var)) {
                $this->dealsData = json_decode($var, true);
                $this->storeToFile($this->dealsDocName, $this->dealsData);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function loadCouchPageDeals()
    {

        try {
            $Couch          = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $docName        = ORBITZ_ENV . ":merch:deals:" . md5(trim($this->setPageUrl));
            $pageUrlData    = $Couch->get($docName);
            $pageUrlData = empty($pageUrlData) ? $this->getFileData($docName) : $pageUrlData;

            $this->pageUrlData = json_encode(['data' => json_decode($pageUrlData, TRUE),
                'info' => ['url' => $this->setPageUrl, 'docName' => $docName]
            ]);
            $this->storeToFile($docName, $this->pageUrlData);
            //print_r($this->pageUrlData);
            //`exit;
//            $this->pageUrlData = $Couch->get($this->urlDocName);
            //echo $this->setPageUrl . '****'. md5('world-is-on-sale-sale/europe--uae') . '****'.md5($this->setPageUrl);
            // print_r($this->pageUrlData);
            //exit;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function loadCouchLanguage()
    {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get($this->langDocName);
            $var = empty($var) ? $this->getFileData($this->langDocName) : $var;
            if (!empty($var)) {
                $this->langData = json_decode($var, true);
                $this->storeToFile($this->langDocName, $this->langData);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function loadCouchMenu()
    {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get($this->menuDocName);
            $var = empty($var) ? $this->getFileData($this->menuDocName) : $var;
            if (!empty($var)) {
                $this->menuData = json_decode($var);
                $this->storeToFile($this->menuDocName, $this->menuData);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * Load the campaign data
     *
     * @return bool|array
     */
    public function loadCampaignData()
    {
        try {
            if (isset($this->dealsData['urls'])) {
                return $this->dealsData['urls'];
            }
            return false;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * Default flag is TRUE -> if primary data is not exists then, it will load default data
     *
     * @param boolean $defaultFlag
     * @return array | boolean
     */
    public function loadBannerData($defaultFlag = false)
    {

        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get(md5(strtolower($this->campaignName)) . ':' . $this->languageCode . ':banner');
            if (!empty($var)) {
                return json_decode($var, true);
            }

            if ($defaultFlag == true) {
                $varDefault = $Couch->get(
                    md5(strtolower(self::DEFAULT_PAGE_CAMPAIGN)) . ':' . self::DEFAULT_PAGE_LANG . ':banner'
                );
                if (!empty($varDefault)) {
                    return json_decode($varDefault, true);
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * Load the hotel deals
     *
     * @return bool|array
     */
    public function loadHotelData()
    {
        try {
            if (isset($this->dealsData['deals'])) {
                return $this->dealsData['deals'];
            }
            return false;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function getBanner($campaign)
    {
        try {
            if (!empty($this->dealsData['banner']) && key_exists($campaign, $this->dealsData['banner'])) {
                return $this->dealsData['banner'][$campaign];
            } else {
                return array_shift($this->dealsData['banner']);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return false;
    }

    /**
     * To get all hotels inside the city
     *
     * @param type $region
     * @param type $country
     * @param type $city
     * @return type array
     */
    public function getCityHoteles($region, $country, $city)
    {
        $data = [];
        if (isset($this->dealsData['campaign'][$region][$country][$city])) {
            foreach ($this->dealsData['campaign'][$region][$country][$city] as $key => $val) {
                if ($key != 'name' && $key != 'sort' && $key != 'city_name_en') {
                    $data[$key] = $val;
                }
            }
        }
        return $data;
    }

    public function getCountryHoteles($region, $country, $limit = 2)
    {
        $data = [];
        if (isset($this->dealsData['campaign'][$region][$country])) {
            $cntName = false;
            $ctyCnt  = 0;
            foreach ($this->dealsData['campaign'][$region][$country] as $key => $val) {
                if ($key != 'name' && $key != 'sort' && $key != 'country_code') {
                    //Remove unwanted keys
                    unset($val['sort'], $val['name'], $val['country_code']);

                    //Sort the data using sork key
                    uasort(
                        $val,
                        function ($a, $b) {
                            if (isset($a['sort']) && isset($b['sort'])) {
                                if ($a['sort'] == $b['sort']) {
                                    return 0;
                                }
                                return ($a['sort'] < $b['sort']) ? -1 : 1;
                            }
                        }
                    );

                    foreach ($val as $k => $v) {
                        if ($k != 'name' && $k != 'sort' && $k != 'city_name_en') {
                            if ($limit == false) {
                                $data[$k] = $v;
                            } else {
                                if ($key == $cntName) {
                                    if ($ctyCnt < $limit) {
                                        $data[$k] = $v;
                                        $ctyCnt++;
                                    } else {
                                        continue;
                                    }
                                } else {
                                    $cntName  = $key;
                                    $ctyCnt   = 1;
                                    $data[$k] = $v;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    public function getRegionHoteles($region, $limit = 2)
    {
        $data = [];
        if (isset($this->dealsData['campaign'][$region])) {
            $cntName = false;
            $ctyCnt  = 0;
            foreach ($this->dealsData['campaign'][$region] as $keyRegion => $value) {
                if ($keyRegion != 'name' && $keyRegion != 'sort' && $keyRegion != 'name_en') {
                    foreach ($value as $key => $val) {
                        if ($key != 'name' && $key != 'sort' && $key != 'country_code') {
                            //Remove unwanted keys
                            unset($val['sort'], $val['name'], $val['country_code']);
                            //Sort the data using sork key
                            uasort(
                                $val,
                                function ($a, $b) {
                                    if (isset($a['sort']) && isset($b['sort'])) {
                                        if ($a['sort'] == $b['sort']) {
                                            return 0;
                                        }
                                        return ($a['sort'] < $b['sort']) ? -1 : 1;
                                    }
                                }
                            );

                            foreach ($val as $k => $v) {
                                if ($k != 'name' && $k != 'sort' && $k != 'city_name_en') {
                                    if ($limit == false) {
                                        $data[$k] = $v;
                                    } else {
                                        if ($key == $cntName) {
                                            if ($ctyCnt < $limit) {
                                                $data[$k] = $v;
                                                $ctyCnt++;
                                            } else {
                                                continue;
                                            }
                                        } else {
                                            $cntName  = $key;
                                            $ctyCnt   = 1;
                                            $data[$k] = $v;
                                        }
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

    public function getDefaultHoteles()
    {
        return $this->getRegionHoteles($this->region);
    }

    public function getFirstRegion()
    {
        if (isset($this->dealsData['campaign']) && !empty($this->dealsData['campaign'])) {
            return key($this->dealsData['campaign']);
        }
        return false;
    }

    public function isLanguageExists()
    {
        if (!empty($this->langData)) {
            return true;
        }

        return false;
    }

    public function isValidDefaultCampaign()
    {

        $this->dealsDocName = "merch:deals:" . md5(
                strtolower(self::DEFAULT_PAGE_CAMPAIGN) . '/'
            ) . ":" . self::DEFAULT_PAGE_LANG;
        $this->loadCouchDeals();
        if ($this->dealsData == null) {
            return false;
        }

        return true;
    }

    public function isCampaignExists($campaignName)
    {
        if ($campaignName) {
            $appData = $this->getAppData();
            return array_key_exists($campaignName, $appData['campaigns']);
        }

    }


    public function setDefaultLang()
    {
        try {
            $this->langDocName = "merch:lang:" . md5('lang-' . self::DEFAULT_PAGE_LANG) . ":" . self::DEFAULT_PAGE_LANG;
            $this->loadCouchLanguage();
            if (!empty($this->langData)) {
                return true;
            }

            return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $this->session->set('languageCode', self::DEFAULT_PAGE_LANG);
    }


    /**
     * @param mixed $menuTabMain
     */
    public function setMenuTabMain($menuTabMain)
    {
        $this->menuTabMain = $menuTabMain;
        return $this;
    }

    /**
     * @param mixed $menuTabSub
     */
    public function setMenuTabSub($menuTabSub)
    {
        $this->menuTabSub = $menuTabSub;
        return $this;
    }

    public function getConnectionService()
    {

    }

    public function setForceExists($bool = true)
    {

    }

    public function dumpResult($var, $foo)
    {

    }

    public function getConnection()
    {

    }

    /**
     * @return mixed
     */
    public function getCampaignName()
    {
        if (null === $this->campaignName) {
            $this->setCampaignName();
        }
        return $this->campaignName;
    }

    /**
     * @param mixed $campaignName
     */
    public function setCampaignName($campaignName = null)
    {
        $campaignName = null === $campaignName ? $this->campaignName : $campaignName;
        $this->campaignName = $campaignName;
        if (null ===  $this->campaignName) {
            // Then get default
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCampaignThumbnail()
    {
        return $this->campaignThumbnail;
    }

    /**
     * @param mixed $campaignThumbnail
     */
    public function setCampaignThumbnail($campaignThumbnail)
    {
        $this->campaignThumbnail = $campaignThumbnail;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCity()
    {
        if(null === $this->city){
            $this->setCity();
        }
        return $this->city;
    }

    /**
     * @param $city
     * @return $this
     */
    public function setCity($city = null)
    {
        $city = null === $city ? $this->city : $city;
        $this->city = $city;
        if(null === $this->city){
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        if(null === $this->country){
            $this->setCountry();
        }
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country = null)
    {
        $country = null === $country ? $this->country : $country;
        $this->country = $country;
        if(null === $this->country){
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        if(null === $this->countryCode){
            $this->setCountryCode();
        }
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode = null)
    {
        $countryCode = null === $countryCode ? $this->countryCode : $countryCode;
        $this->countryCode = $countryCode;
        if(null === $this->countryCode){
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCurrency()
    {
        if(null === $this->currency){}
        $this->setCurrency();
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency = null)
    {
        $currency = null === $currency ? $this->currency : $currency;
        $this->currency = $currency;
        if(null === $this->currency){
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        if(null == $this->languageCode){
            $this->setLanguageCode();
        }
        return $this->languageCode;
    }

    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode = null)
    {
        $languageCode = null === $languageCode ? $this->languageCode : $languageCode;
        $this->languageCode = $languageCode;
        if(null === $this->languageCode){
            $this->setupDefaultsFromAppDoc();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        if(null === $this->region){
            $this->setRegion();
        }
        return $this->region;
    }

    /**
     *
     * @param String $region
     * @return \HC\Merch\Models\Page
     */
    public function setRegion($region = null)
    {
        $region = null === $region ? $this->region : $region ;
        $this->region = $region;
//        if(null === $this->region){
//            $this->setupDefaultsFromAppDoc();
//        }
        return $this;
    }


    /**
     * @return null
     */
    public function getAppData()
    {
        if (null === $this->appData) {
            $this->setAppData();
        }
        return $this->appData;
    }

    /**
     * @param null $appData
     */
    public function setAppData()
    {
        $this->loadCouchAppData();
        return $this;
    }


    public function setupDefaultsFromAppDoc()
    {
        $appData = $this->getAppData();

        if ($appData) {
            $campaignName = !empty($this->appData['default_campaign']['name']) ? $this->appData['default_campaign']['name'] : self::DEFAULT_PAGE_CAMPAIGN;
            if ($this->isCampaignExists($campaignName)) {
                $campaign = $appData['campaigns'][$campaignName];
                $this->setCampaignName($campaignName)
                    ->setCampaignThumbnail($campaign['thumbnail']);

                $this->setCity($campaign['city'])
                    ->setCountry($campaign['country'])
                    ->setCountryCode($campaign['country_code'])
                    ->setCurrency($campaign['currency'])
                    ->setLanguageCode($campaign['locale'])
                    ->setLayout($campaign['layout'])
                    ->setRegion($campaign['region']);
            }
        }
    }

    protected function storeToFile($fileName, $fileData){
        $filePath = __DIR__ . self::FILE_CACHE_PATH . str_replace(':','_', $fileName ). '.json';
        $storeFile = true;
        if(file_exists($filePath)){
            $interval = strtotime('-24 hours');
            if (filemtime($filePath) <= $interval ){
              $storeFile = true;
            } else{
                $storeFile = false;
            }
        }
        if($storeFile){
            $file = fopen($filePath, 'w');
            fputs($file, json_encode($fileData));
            fclose($file);
        }

    }

    protected function getFileData($fileName){

        $filePath = __DIR__ . self::FILE_CACHE_PATH . str_replace(':','_', $fileName ). '.json';
        if(file_exists($filePath)) {
            $stream = fopen($filePath, "r");
            $return = stream_get_contents($stream);
            fclose($stream);
            return $return;
        }
    }

}