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
    const DOC_NAME_COUNTRY_OPTIONS = 'country_options';
    const DOC_NAME_CURRENCY = 'currency';
    const DOC_NAME_TRANSLATION = 'translation';
    const DOC_NAME_SEARCH_REGIONS = 'search_regions';

    /** define cms document names */
    const DOC_NAME_PROMO_CLUB = 'promo_club';
    const DOC_NAME_PROMO_PM = 'promo_pm';
    const DOC_NAME_FOOTER_SEO = 'footer_seo';
    const DOC_NAME_FOOTER_ABOUT = 'footer_about';
    const DOC_NAME_HTML_HEAD = 'html_head';
    const DOC_NAME_HTML_BODY_START = 'html_body_start';
    const DOC_NAME_HTML_BODY_END = 'html_body_end';

    const DEFAULT_CAMPAIGN_NAME='deals';
    const DEFAULT_REGION='Australia, New Zealand Pacific';
    const DEFAULT_SEARCH_REGION_INDEX = 0;
    const DEFAULT_COUNTRY_CODE='AU';
    const DEFAULT_CITY = 'Sydney';
    const DEFAULT_TRAVEL_PERIOD = '30-days';

    const DEFAULT_LOCALE = 'en_AU';
    const DEFAULT_CURRENCY = 'AUD';

    const BASE_URL = 'http://www.hotelclub.com';
    const SERVICE_URI_LOCATION_PROD = 'http://teakettle.prod.o.com/location/geoip/city/';
    const SERVICE_URI_LOCATION_DEV = 'http://teakettle.qa1.o.com/location/geoip/city/';
    const SERVICE_URI_LOCATION_PROXY = 'http://www.hotelclub.com/n/api/proxy/request/';

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


    protected $clientIp;

    protected $clientGeoLocation;

    protected $clientCountryCode;
    protected $clientCountry;
    protected $clientCity;
    protected $clientDefaultLocale;
    protected $clientDefaultCurrency;
    protected $clientDefaultCity;

    public $searchRegions;

    /**
     * initialize stuffs
     */

    public function initialize() {
        $this->init();
    }

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

        $couchDocName = ORBITZ_ENV . ':'. self::DOC_PREFIX .':' . md5($this->getCampaignName()) . ':' . $suffix;

        if ($postFixType == 'locale') {
            $couchDocName .=  ':'. strtolower($this->getLocale());
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
        return null === $this->locale ? $this->getClientDefaultLocale() : $this->locale;
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
    public function getProviderResponse($requestParams)
    {
        $provider = Request::getProvider();
        $provider->setBaseUri(self::BASE_URL);
        $provider->header->set('Accept', 'application/json');
        $requestUri = ORBITZ_ENV === 'production' ? self::SERVICE_URI_LOCATION_PROD : self::SERVICE_URI_LOCATION_DEV;
        return $provider->get($requestUri, $requestParams);
    }

    public function setupClientLocationOptions(){
        if(null !== $this->getClientIp()){
            $this->setClientGeoLocation();
            if($this->getClientGeoLocation()){
                $this->setClientCountry($this->getClientGeoLocation()->country_name);
                $this->setClientCountryCode($this->getClientGeoLocation()->country_code);
                $this->setClientCity($this->getClientGeoLocation()->city_name);

                $countryOptionDocumentName = $this->buildUrl(self::DOC_NAME_COUNTRY_OPTIONS,'locale');
                $countryOptionData = $this->getDocument($countryOptionDocumentName, true);

                if(!empty($countryOptionData[$this->getClientCountryCode()])){

                    $regionPos = $countryOptionData[$this->getClientCountryCode()]['search_region'];

                    $searchRegions = $this->getDocument(
                        $this->buildUrl(self::DOC_NAME_SEARCH_REGIONS, 'locale'),
                        true
                    );

                    $this->searchRegions = null != $searchRegions && isset($searchRegions[$regionPos])
                        ? $searchRegions[$regionPos]
                        : $searchRegions[self::DEFAULT_SEARCH_REGION_INDEX];


                    $countryOption = $countryOptionData[$this->getClientCountryCode()];
                    $this->setClientDefaultLocale($countryOption['locale']);
                    $this->setClientDefaultCurrency($countryOption['currency']);
                    $this->setClientDefaultCity($countryOption['city']);
                } else {
                    $this->setClientDefaultLocale(self::DEFAULT_LOCALE);
                    $this->setClientDefaultCurrency(self::DEFAULT_CURRENCY);
                    $this->setClientDefaultCity(self::DEFAULT_CITY);
                }

            }
        }
    }


    /**
     * @return mixed
     */
    public function getClientCountry()
    {
        return $this->clientCountry;
    }

    /**
     * @param mixed $clientCountry
     */
    public function setClientCountry($clientCountry)
    {
        $this->clientCountry = $clientCountry;
    }

    /**
     * @return mixed
     */
    public function getClientCountryCode()
    {
        return null === $this->clientCountryCode ? self::DEFAULT_COUNTRY_CODE : $this->clientCountryCode;
    }

    /**
     * @param mixed $clientCountryCode
     */
    public function setClientCountryCode($clientCountryCode)
    {
        $this->clientCountryCode = $clientCountryCode;
    }

    /**
     * @return mixed
     */
    public function getClientCity()
    {
        return $this->clientCity;
    }

    /**
     * @param mixed $clientCity
     */
    public function setClientCity($clientCity)
    {
        $this->clientCity = $clientCity;
    }


    /**
     * @return mixed
     */
    public function getClientDefaultCity()
    {
        return null ==$this->clientDefaultCity ? self::DEFAULT_CITY : $this->clientDefaultCity;
    }

    /**
     * @param mixed $clientDefaultCity
     */
    public function setClientDefaultCity($clientDefaultCity)
    {
        $this->clientDefaultCity = $clientDefaultCity;
    }

    /**
     * @return mixed
     */
    public function getClientDefaultCurrency()
    {
        return null === $this->clientDefaultCurrency ? self::DEFAULT_CURRENCY : $this->clientDefaultCurrency;
    }

    /**
     * @param mixed $clientDefaultCurrency
     */
    public function setClientDefaultCurrency($clientDefaultCurrency)
    {
        $this->clientDefaultCurrency = $clientDefaultCurrency;
    }

    /**
     * @return mixed
     */
    public function getClientDefaultLocale()
    {
        return null === $this->clientDefaultLocale ? self::DEFAULT_LOCALE : $this->clientDefaultLocale;
    }

    /**
     * @param mixed $clientDefaultLocale
     */
    public function setClientDefaultLocale($clientDefaultLocale)
    {
        $this->clientDefaultLocale = $clientDefaultLocale;
    }

    /**
     * @return mixed
     */
    public function getClientGeoLocation()
    {
        return $this->clientGeoLocation;
    }

    /**
     * @param mixed $clientGeoLocation
     */
    public function setClientGeoLocation()
    {
        $requestParams = ['ip' =>  $this->getClientIp()];
        try{
            $clientGeoLocation = $this->getProviderResponse($requestParams);
        } catch (\Exception $e) {
//            $this->getExceptionMessage($e);
             $proxyPaylod = [
            'host' => self::SERVICE_URI_LOCATION_PROD,
            'port' => null,
            'headers[Accept]' => 'application/json',
            'payload' => '?ip='. $this->getClientIp(),
            'method' => 'GET'
        ]   ;
        $provider  = Request::getProvider();
        $provider->setBaseUri(self::SERVICE_URI_LOCATION_PROXY);
            $clientGeoLocation = $provider->post('', $proxyPaylod);
        }

        if($clientGeoLocation){
            $this->clientGeoLocation = json_decode($clientGeoLocation->body);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientIp()
    {
        if(null === $this->clientIp) $this->setClientIp();
        return $this->clientIp;
    }

    /**
     * @param mixed $clientIp
     */
    public function setClientIp($clientIp = null)
    {
        $clientIp = null == $clientIp ? $this->getIpAddress() : $clientIp;
        $this->clientIp = $clientIp;
    }

    /**
     * @return mixed
     */
    public function getCampaignName()
    {
        return null=== $this->campaignName ? self::DEFAULT_CAMPAIGN_NAME : $this->campaignName;
    }


    public function getIpAddress() {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && $this->validateIp($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if ($this->validateIp($ip))
                        return $ip;
                }
            } else {
                if ($this->validateIp($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->validateIp($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->validateIp($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->validateIp($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validateIp($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    public function validateIp($ip) {
        return true;
        if (strtolower($ip) === 'unknown')
            return false;

        // generate ipv4 network address
        $ip = ip2long($ip);

        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }

    /**
     * Another get ip function
     * @return mixed
     */
    public function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
}