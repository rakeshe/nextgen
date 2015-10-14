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
use Phalcon\Http\Request;

class DealsModel extends \Phalcon\Mvc\Model
{
    /** Define Cms Content used by this app here */
    const DOC_PREFIX = 'sale';

    /** define frame work documents names */
    const DOC_NAME_MASTER = 'campaigns';

    const DEFAULT_REGION='Australia, New Zealand Pacific';
    const DEFAULT_CITY = 'Sydney';
    const DEFAULT_TRAVEL_PERIOD = '30-days';

    const DEFAULT_LOCALE = 'en_AU';
    const DEFAULT_CURRENCY = 'AUD';

    protected $locale = 'en_AU';

    private $dataCacheFilePath;

    /** @var array Set default document names */
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

    /** @var  sting campaign name */
    public $campaignName;

    /**
     * @var string master document name
     */
    public $masterDocName;

    /**
     * @var string deals doc name
     */
    protected $dealsDocName;

    /** @var string currency code */
    public $currency;

    /** @var  string city list document data */
    public $cityListDocData;

    /** @var string footer data */
    public $docFooterSeoDocData;

    /** @var string seo doc data */
    public $docSeoDocData;

    /** @var string footer about data */
    public $docFooterAboutDocData;

    /** @var string htnml head data */
    public $docHtmlHeadDocData;

    /** @var string html body start data */
    public $docHtmlBodyStartDocData;

    /** @var string doc html body end data */
    public $docHtmlBodyEndDocData;

    /** @var string hero image data */
    public $heroImageDocData;

    /** @var string translation data */
    public $transDocData;

    /** @var string currency document */
    public $currDocDocData;

    /** @var string club promotion data */
    public $clubPromoDocData;

    /** @var string pm promotion data */
    public $pmPromoDocData;

    /** @var string homepage document data */
    public $homePageDocData;

    /** @var string deals data document */
    public $dealsDocData;


    /**
     * initialize stuffs
     */

    public function init() {

        $this->setDocumentNames();

        $this->dataCacheFilePath = __DIR__ . '/../data/one/';
    }

    /**
     * set campaign document name
     *
     * @param $key
     * @param $value
     */

    public function setCampaignDocumentName($key, $value) {

        $this->campaignDocNames[$key] = $value;
    }

    /**
     * To get campaign document name
     * @param $key
     * @return bool
     */

    public function getCampaignDocumentName($key) {

        if (isset($this->campaignDocNames[$key])) {
            return $this->campaignDocNames[$key];
        }
        return false;
    }

    /**
     *  Fetch all couch document and set to class properties
     */
    public function loadCouchDocuments() {

        $this->cityListDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['city_list'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:footer_seo:zh_cn
        $this->docFooterSeoDocData =  $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['footer_seo'] ), true
        );

        $this->docSeoDocData =  $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['seo'] ) );


        $this->docFooterAboutDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['footer_about'] ), true
        );

        $this->docHtmlHeadDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['html_head'] ), true
        );

        $this->docHtmlBodyStartDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['html_body_start'] ), true
        );

        $this->docHtmlBodyEndDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['html_body_end'] ), true
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:hero_images:en_au
        $this->heroImageDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['hero_images'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:translation:en_au
        $this->transDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['translation'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:currency:aud
        $this->currDocDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['currency'], 'currency')
        );

        $this->clubPromoDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['promo_club'])
        );

        $this->pmPromoDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['promo_pm'])
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:homepage:en_au
        $this->homePageDocData = $this->getDocument(
            $this->buildUrl( $this->campaignDocNames['homepage'])
        );
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

	public function getDealInfo(){
		$this->userId = '';//making userId NULL
		//IP address for particular countries
		//81.201.86.45 -- HK
		//110.33.122.75 -- AU
		//178.32.63.223 -- UK (GB)
		//128.101.101.101 -- US
		//219.93.183.103 --MY
		//1.0.16.0 -- JP

		$reader = \Phalcon\DI\FactoryDefault::getDefault()['geoIP']; //Fetching Ipaddress and there values

        //$clientIp = $this->request->getClientAddress();//Fetches original Ipaddress of client Id
		$clientIp = '81.201.86.45';//default Ipaddress for HK (Hong Kong)

		$record = $reader->country($clientIp);

		$localeVal = $record->raw['country']['iso_code'];
		$reader = \Phalcon\DI\FactoryDefault::getDefault()['config'];//fetch config details
		$urlTemp = explode('/',$_REQUEST['_url']);//spliting fetched URL

		//setting cookie values
		$_COOKIE['AustinLocale'] = 'zh_hk';
		$_COOKIE['curr'] = 'HKD';
		$cookie_locale = $_COOKIE['AustinLocale'];
		$cookie_curr = $_COOKIE['curr'];

		//Condition to check the locale cookie
		if($localeVal=='HK'&&($cookie_locale=='en_AU')&&($cookie_curr=='AUD')){
			$localeTemp['locale'] = 'en_AU';
			$localeTemp['currency'] = 'AUD';
		}
		elseif($localeVal=='AU'&&($cookie_locale=='zh_HK')&&($cookie_curr=='CNY')){
			$localeTemp['locale'] = 'zh_HK';
			$localeTemp['currency'] = 'CNY';
		}
		elseif($localeVal=='GB'&&($cookie_locale=='en_AU')&&($cookie_curr=='USD')){
			$localeTemp['locale'] = 'en_AU';
			$localeTemp['currency'] = 'USD';
		}
		elseif($localeVal=='US'&&($cookie_locale=='en_AU')&&($cookie_curr=='GBP')){
			$localeTemp['locale'] = 'en_AU';
			$localeTemp['currency'] = 'GBP';
		}
		elseif($localeVal=='HK'&&($urlTemp[2]!='en_AU')){
			$localeTemp['locale'] = $reader->locales->$localeVal;
			if($_COOKIE['curr']!=""){ $localeTemp['currency'] = $_COOKIE['curr'];}
			else{ $localeTemp['currency'] = 'HKD'; }
		}
		elseif($localeVal=='HK'&&($urlTemp[2]=='en_AU')){
			$localeTemp['locale'] = 'en_AU';
			if($_COOKIE['curr']!=""){ $localeTemp['currency'] = $_COOKIE['curr'];}
			else{ $localeTemp['currency'] = 'AUD'; }
		}
		elseif($localeVal=='AU'&&($urlTemp[2]=='en_AU')){
			$localeTemp['locale'] = 'en_AU';
			if($_COOKIE['curr']!=""){ $localeTemp['currency'] = $_COOKIE['curr'];}
			else{ $localeTemp['currency'] = 'AUD'; }
		}
		elseif($localeVal=='GB'&&($urlTemp[2]=='en_AU')){
			$localeTemp['locale'] = 'en_AU';
			if($_COOKIE['curr']!=""){ $localeTemp['currency'] = $_COOKIE['curr']; }
			else{ $localeTemp['currency'] = 'AUD';//GBP needed to be added in the currency and modify the currency to GBP
			}
		}
		elseif($localeVal=='US'&&($urlTemp[2]=='en_AU')){
			$localeTemp['locale'] = 'en_AU';
			if($_COOKIE['curr']!=""){ $localeTemp['currency'] = $_COOKIE['curr'];}
			else{ $localeTemp['currency'] = 'AUD';//USD needed to be added in the currency and modify the currency to USD
			}
		}
		else{
			$localeTemp['locale'] = $this->locale;
			$localeTemp['currency'] = 'AUD';//USD needed to be added in the currency and modify the currency to USD
		}
		return $localeTemp;
	}
}