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
use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class DealsModel extends \Phalcon\Mvc\Model
{
    /** Define Cms Content used by this app here */
    const DOC_PREFIX = 'sale';

    /** define frame work documents names */
    const DOC_NAME_MASTER = 'campaigns';
    const DOC_NAME_HOMEPAGE = 'homepage';
    const DOC_NAME_HERO_IMAGES = 'hero_images';
    const DOC_NAME_CITY_LIST = 'city_list';
    const DOC_NAME_CURRENCY = 'currency';
    const DOC_NAME_TRANSLATION = 'translation';

    /** define cms document names */
    const DOC_NAME_PROMO_CLUB = 'promo_club';
    const DOC_NAME_PROMO_PM = 'promo_pm';
    const DOC_NAME_FOOTER_SEO = 'footer_seo';
    const DOC_NAME_FOOTER_ABOUT = 'footer_about';
    const DOC_NAME_HTML_HEAD = 'html_head';
    const DOC_NAME_HTML_BODY_START = 'html_body_start';
    const DOC_NAME_HTML_BODY_END = 'html_body_end';

   /* const PROMOTIONS_CLUB_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_club'; // sale:md5(deals):promo_club
    const PROMOTIONS_PM_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_pm'; // sale:md5(deals):promo_pm
    const DOC_NAME_FOOTER_SEO_LINKS = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_seo';
    const DOC_NAME_FOOTER_ABOUT = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_about';
    const HEROES_IMAGE_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:hero_images'; //sale:md5('deals'):heroes_images

    const DOC_HTML_HEAD = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_head'; //sale:md5('deals'):html_head
    const DOC_HTML_BODY_START = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_body_start'; //sale:md5('deals'):html_body_start
    const DOC_HTML_BODY_END = 'sale:6c996181cb66b09cf475386ff06ad9e2:html_body_end';  //sale:md5('deals'):html_body_end
    
    const DEALS_TRANSLATION_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:translation'; //sale:md5('deals'):translation
    const DEALS_CURRENCY_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:currency'; //sale:md5('deals'):currency*/

    const DEFAULT_REGION='Australia, New Zealand Pacific';
    const DEFAULT_CITY = 'Sydney';
    const DEFAULT_TRAVEL_PERIOD = '30-days';

    const DEFAULT_LOCALE = 'en_AU';
    const DEFAULT_CURRENCY = 'AUD';

    const SERVICE_URI_LOCATION = '//teakettle.qa1.o.com/location/geoip/city';

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
        'seo'           => 'seo'
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

    /**
     * initialize stuffs
     */

    public function init() {

        $this->setDocumentNames();

        $this->dataCacheFilePath = __DIR__ . '/../data/one/';
    }

    /**
     * set couch document names
     */
    public function setDocumentNames() {

        $this->masterDocName =  ORBITZ_ENV . ':sale:'. self::DOC_NAME_MASTER ; //. ':' . strtolower($this->getLocale());
    }

    /** Get document form couch, if it's not exists, this ll load form file system
     *
     * @param $docName string
     * @param bool $decode
     * @return bool|mixed|string
     */

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
//            $data = str_replace("'", "&#39;", $data);

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

    /**
     * @param $requestUri
     * @param $requestParams
     * @return \Phalcon\Http\Client\Response
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    protected function getProviderResponse($requestUri, $requestParams)
    {
        $provider = Request::getProvider();
        $provider->setBaseUri(self::BASE_URL);
        $provider->header->set('Accept', 'application/json');
        return $provider->get($requestUri, $requestParams);
    }

}