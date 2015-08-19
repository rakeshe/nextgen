<?php

/**
 *
 * @package    DealsModel.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Models;

use Phalcon\Exception;

class DealsModel extends \Phalcon\Mvc\Model
{
    /** Define Cms Content used by this app here */
    const DOC_PREFIX = 'sale';

    const MASTER_DOC_NAME = 'master_document';

    const PROMOTIONS_CLUB_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_club'; // sale:md5(deals):promo_club
    const PROMOTIONS_PM_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_pm'; // sale:md5(deals):promo_pm
    const DOC_NAME_FOOTER_SEO_LINKS = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_seo';
    const DOC_NAME_FOOTER_ABOUT = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_about';
    const HEROES_IMAGE_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:hero_images'; //sale:md5('deals'):heroes_images

    const DOC_HTML_HEAD = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_head'; //sale:md5('deals'):html_head
    const DOC_HTML_BODY_START = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_body_start'; //sale:md5('deals'):html_body_start
    const DOC_HTML_BODY_END = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_body_end';  //sale:md5('deals'):html_body_end
    
    const DEALS_TRANSLATION_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:translation'; //sale:md5('deals'):translation
    const DEALS_CURRENCY_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:currency'; //sale:md5('deals'):currency

    const DEFAULT_REGION='Australia, New Zealand Pacific';
    const DEFAULT_CITY = 'Sydney';
    const DEFAULT_TRAVEL_PERIOD = '30-days';

    const DEFAULT_LOCALE = 'en_AU';
    const DEFAULT_CURRENCY = 'AUD';

    protected $locale = 'en_AU';

    private $dataCacheFilePath;

    public $campaignDocNames = [
        'city_list'     => 'city_list',
        'homepage'      => 'homepage',
        'promo_club'    => 'promo_club',
        'promo_pm'      => 'promo_pm',
        'footer_seo'    => 'footer_seo',
        'footer_about'  => 'footer_about',
        'hero_images'   => 'hero_images',
        'html_head'     => 'html_head',
        'html_body_start' => 'html_body_start',
        'html_body_end' => 'html_body_end',
        'translation'   => 'translation',
        'currency'      => 'currency',
    ];

    public $campaignName;

    /**
     * @var master document name
     */
    public $masterDocName;

    /**
     * @var deals doc name
     */
    protected $dealsDocName;

    /**
     * @var currency code
     */
    public $currency;

    public function init() {

        $this->setDocumentNames();

        $this->dataCacheFilePath = __DIR__ . '/../data/one/';
    }

    public function setDocumentNames() {

        $this->masterDocName =  ORBITZ_ENV . ':sale:'. md5(self::MASTER_DOC_NAME) . ':' . strtolower($this->getLocale());
    }


    public function getCityDocument() {

/*        try{
            $data = file_get_contents( __DIR__ . '/../data/city.json');
            return $data;
        }catch (\Exception $e) {

        }*/
        try{
            //var_dump(\Phalcon\DI::getDefault()->getService('config')); exit;
            // format: production:sale:md5(deals/city):en_AU
            $docUrl = 'deals/city';
            $couchDocName = ORBITZ_ENV . ':sale:'. md5($docUrl) . ':' . $this->getLocale();
            $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }
            $data = null == $data ? '{}' : $data;
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getHotels($region=self::DEFAULT_REGION, $city=self::DEFAULT_CITY, $when = self::DEFAULT_TRAVEL_PERIOD) {

        try{
            // format: production:sale:md5(deals/Sydney/30-days):en_AU
            $cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $docUrl = 'deals/'. $cityName .'/'. $when;
            $couchDocName = ORBITZ_ENV . ':sale:'. md5($docUrl) . ':' . $this->getLocale();
            echo $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json'; exit;

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }
            $data = null == $data ? '{}' : str_replace("'", "&#39;", $data);
            /*$cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $dataFile = $cityName.'.json';
            $data = file_exists(__DIR__ .'/../data/'. $dataFile) ?
                file_get_contents(__DIR__ .'/../data/'. $dataFile) :
                '{}';*/
            //file_get_contents( __DIR__ . '/../data/deals.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    /** landign page Inspiration section data */
    public function getPromoCardDoc() {

        try{
            // format: production:sale:md5(deals/promoCardDoc):en_AU
            $docUrl = 'deals/promoCardDoc';
            $couchDocName = ORBITZ_ENV . ':sale:'. md5($docUrl) . ':' . $this->getLocale();
            $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json';
            //dev_sale_7c6fa5c0ad27c0a6ffbed17f23b644d8_en_au.json

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }
            $data = null == $data ? '{}' : trim(str_replace("'", "&#39;", $data));
            //echo json_encode(json_decode($data)); exit;
            /*$cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $dataFile = $cityName.'.json';
            $data = file_exists(__DIR__ .'/../data/'. $dataFile) ?
                file_get_contents(__DIR__ .'/../data/'. $dataFile) :
                '{}';*/
            //file_get_contents( __DIR__ . '/../data/deals.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getUserInfo($memberId) {

        try{
            $data = file_get_contents( __DIR__ . '/../data/loyalty_member.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getLoyaltyInfo($memberId) {

        try{
            $data = file_get_contents( __DIR__ . '/../data/user-info.json');
            return $data;
        }catch (\Exception $e) {

        }

    }

    public function getClubPromotions() {

        try {

            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get(ORBITZ_ENV . self::PROMOTIONS_CLUB_DOC_NAME);

            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/club-promotion.json')) {
                    return file_get_contents( __DIR__ . '/../data/club-promotion.json');
                }
                return false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function getPMPromotions() {

        try {

            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get(ORBITZ_ENV . self::PROMOTIONS_PM_DOC_NAME);

            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/pm-promotion.json')) {
                    return file_get_contents( __DIR__ . '/../data/pm-promotion.json');
                }
                return false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * Given document name, retrieve from Couch first, then file system if fails
     * @param      $documentName
     * @param bool $decode
     * @return mixed|null
     */
    public function getCmsDocument($documentName, $decode = false) {

        $return = false;
        $cmsDocument = $this->getCmsDocumentByLocale($documentName, $this->getLocale());
        $cmsDocument =  $cmsDocument ? $cmsDocument : $this->getCmsDocumentByLocale($documentName);
       if($cmsDocument){
           $return =  $decode ? json_decode($cmsDocument) : str_replace("'", "&#39;", $cmsDocument);

        }
        return $return;
    }

    public function getCmsDocumentByLocale($documentName, $locale= self::DEFAULT_LOCALE){
        try {
            $couchDocName = ORBITZ_ENV . ':'. $documentName . ':'. $locale;
            $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {
                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }

            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getCurrencyDocument($docName, $currency) {

        try {
            $couchDocName = ORBITZ_ENV . ':'. $docName . ':'. $currency;
            $fsDocName = str_replace(':','_', $couchDocName) .'.json';
            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {
                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }

            return $data == false ? '{}' : $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

    }

    public function getDocument($docName, $decode = false) {
        try {

            $fsDocName = strtolower(str_replace(':','_', $docName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($docName);

            // try file system next
            if ($data == false) {
                if(file_exists( $this->dataCacheFilePath . $fsDocName)) {
                    $data = file_get_contents( $this->dataCacheFilePath . $fsDocName);
                }
            }
            $data = str_replace("'", "&#39;", $data);

            if ($decode == true) {
                return $data != false ? json_decode($data, true) : false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * To build all couch doc url
     *
     * @param $suffix string
     * @param string $postFixType string
     * @return string
     */

    public function buildUrl($suffix, $postFixType = 'locale') {

        $couchDocName = ORBITZ_ENV . ':'. self::DOC_PREFIX .':' . md5($this->campaignName) . ':' . $suffix;

        if ($postFixType == 'locale') {
            $couchDocName .=  ':'. strtolower($this->locale);
        } else if ($postFixType == 'currency') {
            $couchDocName .=  ':'. strtolower($this->currency);
        }

        return $couchDocName;

    }

    /**
     * To build deals (hotel deals) url
     *
     * @param $city string
     * @param $when string
     * @return string
     */

    public function buildDealsUrl($city, $when) {

        $cityName = strtolower(str_replace([' ',',','\''], '_', $city));
        $suffix = $this->campaignName .'/'. $cityName .'/'. $when;

        $couchDocName = ORBITZ_ENV . ':'. self::DOC_PREFIX .':' . md5($suffix) . ':deals:' . strtolower($this->getLocale());

        return $couchDocName;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /** Set campaign name
     * @param $name string
     * @return $this
     */
    public function setCampaign($name) {
        $this->campaignName = $name;
        return $this;
    }

    /**
     * Set currency
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }


}