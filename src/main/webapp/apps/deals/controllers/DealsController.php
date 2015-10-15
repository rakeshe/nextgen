<?php

/**
 *
 * @package    DealsController.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Controllers;

use Guzzle\Tests\Common\Cache\NullCacheAdapterTest;
use HC\Deals\Models\DealsModel;
use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class DealsController extends ControllerBase {


    const DEFAULT_CITY = 'Sydney';

    const DEFAULT_WHEN = '30-days';

    const DEFAULT_URI = 'n/sale/deals';

    const DEFAULT_CURR = 'AUD';

    const DEFAULT_LOCALE = 'en_AU';

    const CONTENT_SCOPE_HOME = 'home';
    const CONTENT_SCOPE_DESTINATION = 'destination';
    const CONTENT_SCOPE_DEFAULT = 'default';

    private $cityList;

    /** @var  \HC\Deals\Models\DealsModel  */
    private $model;

    private $city;

    private $when;

    private $sort;

    private $appendURL;

    private $userId;

    private $userInfo;

    private $sortBy;

    private $sortType;

    private $hotels;

    private $currency;

    private $locale;

    private $campaignName;

    private $masterData;

    public function initialize() {

        $this->init();

        $this->sendAjaxResponse();

        if (NULL !== $this->userId)
            $this->setUserInfo();
    }


    public function init() {
        $this->setParams();

        $this->model = new \HC\Deals\Models\DealsModel();

        $this->model->setLocale($this->locale)
                    ->setCampaign($this->campaignName)
                    ->setCurrency($this->currency);

        $this->model->init();

        $this->validateCampaign();

    }

    private function sendAjaxResponse() {

        if ($this->request->isPost() && $this->request->isAjax()) {

            $this->model->currency      = $this->request->getPost('curr', 'string');
            $this->model->campaignName  = $this->request->getPost('cname', 'string');

            $data = [];

            $hotelData = $this->model->getDocument(
                $this->model->buildDealsUrl(
                    $this->request->getPost('city', 'string'),
                    $this->request->getPost('when', 'string')
                ) );

            $data['hData'] = json_decode($hotelData, true);

            $currDoc = $this->model->getDocument(
                $this->model->buildUrl( $this->model->campaignDocNames['currency'], 'currency')
            );

            $data['currData'] = json_decode($currDoc, true);

            die(json_encode($data));
        }
    }

    private function validateCampaign() {

        $this->masterData = $this->model->getDocument( $this->model->masterDocName, true );

        if (false == $this->masterData ) {
            $this->dispatcher->forward([
                'controller' => 'deals',
                'action' => 'show404',
            ]);

        } else if ($this->campaignName == null ||
            array_key_exists($this->campaignName, $this->masterData['data']) == false) {

          //there is no campaign is exists
            $this->dispatcher->forward([
                'controller' => 'deals',
                'action' => 'show404',
            ]);

        }
    }

    private function setParams() {


        if ($this->dispatcher->getParam('campaignName') !== null) {
            $this->campaignName = $this->dispatcher->getParam('campaignName');
        }

        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[0])) {
            $this->city = str_replace('#','',$this->dispatcher->getParams()[0]);
            $this->appendURL .= $this->city . '/';
        } else {
           // $this->city = self::DEFAULT_CITY;
            $this->appendURL .= self::DEFAULT_CITY . '/';
        }


        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[1])) {
            $this->when = $this->dispatcher->getParams()[1];
            $this->appendURL .= $this->when;
        } else {
            //$this->when = self::DEFAULT_WHEN;
            $this->appendURL .= self::DEFAULT_WHEN;
        }

        if (isset($this->request->get()['sort']))
            $this->sort = $this->request->get()['sort'];

        if ($this->cookies->get('mid')->__toString() != '') {
            $this->userId = $this->cookies->get('mid')->__toString();
        }

        //$this->userId = 123;

        if ($this->request->get('sort','string') != NULL &&
            in_array($this->request->get('sort','string'), (array) $this->config->sortBy)) {
            $this->sortBy = $this->request->get('sort','string');

        } else {
            $this->sortBy = end($this->config->sortBy);
        }

        if ($this->request->get('type','string') !== NULL && $this->request->get('type','string') == 'des') {
            $this->sortType = 'des';
        } else {
            $this->sortType = 'asc';
        }

        $this->currency = $this->getCurrency();

        $uris = explode( '/',$this->router->getRewriteUri()) ;
        // detect locale based on url
        if (preg_match("/^[a-z]{2}+_[A-Z]{2}+$/" , $uris[2]) && array_key_exists($uris[2],
                $this->config->languageOptions)) {

            $this->locale = $uris[2];

            if ($this->cookies->get('AustinLocale')->__toString() != $this->locale) {
                $this->cookies->set('AustinLocale', $this->locale, time() + 15 * 86400);
            }

        } elseif($this->request->get('locale','string') != null && array_key_exists($this->request->get('locale','string'),
                $this->config->languageOptions)) {

            $this->locale = $this->request->get('locale','string');

            if ($this->cookies->get('AustinLocale')->__toString() != $this->locale) {
                $this->cookies->set('AustinLocale', $this->locale, time() + 15 * 86400);
            }

        } else {
            $this->locale = SELF::DEFAULT_LOCALE;
        }
    }

    public function indexAction() {

        $this->cases();

        $this->model->loadCouchDocuments();

        $noHotels = '';
        if (null != $this->city && null != $this->when) {
            $this->model->dealsDocData = $this->model->getDocument( $this->model->buildDealsUrl( $this->city, $this->when ) );

            if (false == $this->model->dealsDocData) {
                $noHotels = 'true';
            }
        }

        if (array_key_exists($this->locale, $this->config->dateFormat->locale)) {
            $dateFormat = $this->config->dateFormat->locale[$this->locale]['value'];
            $dateFormatPlaceHolder = $this->config->dateFormat->locale[$this->locale]['placeholder'];
        } else {
            $dateFormat = $this->config->dateFormat->default['value'];
            $dateFormatPlaceHolder = $this->config->dateFormat->default['placeholder'];
        }

        // Add Webtrends tracking
        $webTrends = new \HC\Common\Helpers\WebtrendsHelper();


        $locale = $this->masterData['data'][$this->campaignName]['locales'];
        $l = [];
        foreach(explode(',', $locale) as $loc) {

            if (array_key_exists($loc, $this->config->languageOptions)) {
                $l[$loc] = $this->config->languageOptions[$loc];
            }
         }

        $currencies = $this->masterData['data'][$this->campaignName]['currencies'];
        $c = [];
        foreach(explode(',', $currencies) as  $cur) {

            foreach($this->config->currencies as  $key => $cr) {

                if (array_key_exists($cur, $cr)) {
                    $c[$key][$cur] = $cr[$cur];
                }
            }
        }
        $this->view->setVars(
            [
                'appVersion'          => APPLICATION_VERSION,
                'cityData'            => $this->model->cityListDocData,
                'homePageData'        => $this->model->homePageDocData,
                'city'                => $this->city,
                'when'                => $this->when,
                'sort'                => $this->sort,
                'appendURL'           => $this->appendURL,
                'url'                 => $this->buildSiteUrl(),
                'hData'               => $this->model->dealsDocData,
                'userInfo'            => json_encode($this->userInfo),
                'wtMetaData'          => $webTrends
                    ->setOwwPage($this->router->getRewriteUri())
                    ->getWtMetaData(),
                'wtDataCollectorData' => $webTrends->getWtDataCollectorData(),
                'clubPromo'           => $this->model->clubPromoDocData,
                'pmPromo'             => $this->model->pmPromoDocData,
                'sortBy'              => $this->sortBy,
                'sortType'            => $this->sortType,
                'noHotels'            => $noHotels,
                'heroImages'          => $this->model->heroImageDocData,
                'docFooterSeo'        => $this->getContentByScope($this->model->docFooterSeoDocData),
                'docFooterAbout'      => $this->getContentByScope($this->model->docFooterAboutDocData),
                'docHtmlHead'         => $this->getContentByScope($this->model->docHtmlHeadDocData),
                'docHtmlBodyStart'    => $this->getContentByScope($this->model->docHtmlBodyStartDocData),
                'docHtmlBodyEnd'      => $this->getContentByScope($this->model->docHtmlBodyEndDocData),
                'docSeo'              => $this->model->docSeoDocData,
                'translation'         => $this->model->transDocData,
                'currenciesData'      => json_encode($c),
                'localeData'          => json_encode($l),
                'curr'                => $this->currency,
                'locale'              => $this->locale,
                'currDoc'             => $this->model->currDocDocData,
                'campaignName'        => $this->campaignName,
                'dFormat'             => $dateFormat,
                'dFormatPl'           => $dateFormatPlaceHolder,
            ]
        );

        $this->view->pick('default/index/index');
    }

    /**
     * Define cases and update the app behaviour
     */

    private function cases() {

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

        $currentCountryCode = $record->raw['country']['iso_code'];

        $userId = $this->cookies->get('mid')->__toString(); //making userId NULL


        /*
         * case 1.1
           User with a Hong Kong IP address not logged in, no cookie information, comes to the deals page
        */
        if ($currentCountryCode == 'HK' && $userId == NULL) {

            $this->locale = 'zh_HK'; //set default locale
            $this->currency = 'HKD'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'hk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'hk_city_list');

        }
        /* case 1.2
         * User with an Australian IP address not logged in, no cookie information, comes to the deals page
         */
        elseif ($currentCountryCode == 'AU' && $userId == NULL) {

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'AUD'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'au_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'au_city_list');

        }
        /*
         * cases 1.3
         * User with a UK IP address not logged in, no cookie information, comes to the deals page
         */
        elseif ($currentCountryCode == 'GB' && $userId == NULL) {
            //

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'GBP'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'uk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'uk_city_list');
        }

        /*
         * case 1.4
         * User with a US IP address not logged in, no cookie information, comes to the deals page
         */

        elseif ($currentCountryCode == 'US' && $userId == NULL) {

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'USD'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'us_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'us_city_list');
        }

        /*
         * case 2.1
         * User with HK IP address but the cookie states locale en_AU and AUD currency comes to deals page.
         */

        elseif ($currentCountryCode == 'HK' && $this->cookies->get('AustinLocale')->__toString() == 'en_AU' &&
            $this->cookies->get('curr')->__toString() == 'AUD') {

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'AUD'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'hk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'hk_city_list');
        }

        /*
         * case 2.2
         * User with Australian IP address but the cookie states locale zh_hk and CNY currency comes to deals page.
         */
        elseif ($currentCountryCode == 'AU' && $this->cookies->get('AustinLocale')->__toString() == 'zh_HK'
            && $this->cookies->get('curr')->__toString() == 'CNY') {

            $this->locale = 'zh_HK'; //set default locale
            $this->currency = 'CNY'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'au_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'au_city_list');

        }

        /*
        *c ase 2.3
        * User with UK IP address but the cookie states locale en_AU and USD currency comes to deals page.
        */
        elseif ($currentCountryCode == 'GP' && $this->cookies->get('AustinLocale')->__toString() == 'en_AU' &&
            $this->cookies->get('curr')->__toString() == 'USD') {

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'USD'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            $this->model->setCampaignDocumentName('homepage', 'uk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'uk_city_list');

        }

        /*
        * case 2.4
        * User with US IP address but the cookie states locale en_AU and GBP currency comes to deals page.
        */
        elseif ($currentCountryCode == 'US' && $this->cookies->get('AustinLocale')->__toString() == 'en_AU' &&
            $this->cookies->get('curr')->__toString() == 'GBP') {

            $this->locale = 'en_AU'; //set default locale
            $this->currency = 'GBP'; //set default currency
            $this->model->setLocale($this->locale)
                ->setCurrency($this->currency);

            $this->model->setCampaignDocumentName('homepage', 'uk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'uk_city_list');

        }

        /*
        * case 3.1
        * User with a HK IP clicks on URL  to the deals page (e.g. from an eDM) with the URL parameters locale zh_hk and currency HKD.
        */
        elseif ($currentCountryCode == 'HK' && $this->getUrlLocale() == 'zh_HK' &&
            $this->request->get('curr','string') == 'HKD') {


            $this->model->setCampaignDocumentName('homepage', 'hk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'hk_city_list');

        }

        /*
        * case 3.2
        * User with AU IP clicks on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency AUD.
        */
        elseif ($currentCountryCode == 'AU' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'AUD') {


            $this->model->setCampaignDocumentName('homepage', 'au_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'au_city_list');

        }

        /*
        * case 3.3
        * User with UK IP clicks on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency GBP.
        */
        elseif ($currentCountryCode == 'UK' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'GBP') {


            $this->model->setCampaignDocumentName('homepage', 'uk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'uk_city_list');

        }

        /*
        * case 3.4
        * User with US IP clicks on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency USD.
        */
        elseif ($currentCountryCode == 'US' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'USD') {

            $this->model->setCampaignDocumentName('homepage', 'us_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'us_city_list');

        }

        /*
        * case 4.1
        * User with HK IP address clicks on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency AUD.
        */
        elseif ($currentCountryCode == 'HK' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'AUD') {


            $this->model->setCampaignDocumentName('homepage', 'hk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'hk_city_list');

        }

        /*
        * case 4.2
        * User with Australian IP address clicks on URL to the deals page (e.g. from an eDM) with the URL parameters locale zh_hk and currency CNY.
        */
        elseif ($currentCountryCode == 'AU' && $this->getUrlLocale() == 'zh_HK' &&
            $this->request->get('curr','string') == 'CNY') {

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'au_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'au_city_list');

        }

        /*
        * case 4.3
        * User with UK IP address click on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency USD.
        */
        elseif ($currentCountryCode == 'GB' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'USD') {

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'uk_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'uk_city_list');

        }

        /*
        * case 4.4
        * User with US IP address click on URL to the deals page (e.g. from an eDM) with the URL parameters locale en_AU and currency GBP.
        */
        elseif ($currentCountryCode == 'US' && $this->getUrlLocale() == 'en_AU' &&
            $this->request->get('curr','string') == 'GBP') {

            //override destination document name.
            $this->model->setCampaignDocumentName('homepage', 'us_homepage');

            //override city list document.
            $this->model->setCampaignDocumentName('city_list', 'us_city_list');

        }
    }


    public function setUserInfo() {

        $uInfo = $this->model->getLoyaltyInfo('');
        $lInfo = json_decode($this->model->getUserInfo(''), TRUE);


        if (NULL !== $uInfo) {

            foreach(json_decode($uInfo, TRUE) as $key => $val) {

                if ($key == 'lite_member') {
                    $this->userInfo['mId']   = (!isset($val['member_id'])) ? '' : $val['member_id'];
                    $this->userInfo['name']  = (!isset($val['name'])) ? '' : $val['name'];
                    $this->userInfo['email'] = (!isset($val['email_address'])) ? '' : $val['email_address'];
                }
            }
        }

        if (NULL !== $lInfo) {

            $this->userInfo['mid'] = $lInfo['loyalty_member_number'];
            $this->userInfo['tierType'] = $lInfo['tier_type'];
            $this->userInfo['availAmount'] = $lInfo['available_amount'];
            $this->userInfo['availAmountInUsrCurr'] = $lInfo['available_amount_in_member_currency'];
        }
    }

    protected function getWtMetaData(){
        return [
            'DCSext.LNG' => null === $this->languageCode ? 'en_AU' : $this->languageCode ,
            'DCSext.pos' => 'HCL',
            'DCSext.hostname' => 'www.hotelclub.com',
            'DCSext.owwPage' =>  $this->router->getRewriteUri()
        ];

    }

    private function buildSiteUrl() {
        $url = 'n';
        if ($this->locale != self::DEFAULT_LOCALE) {
            $url .= '/' . $this->locale;
        }
		$url .= '/sale/' . $this->campaignName;
        return $url;
    }

    public function show404Action() {

        exit('404');

/*        $this->dispatcher->forward(array(
                'controller' => 'deals',
                'action' => 'index'
            ));*/
//        $this->response->redirect ( 'merch/' . $this->languageCode . '/' . $this->campaignName );

    }


    /**
     * Logic use value if set in url param, fallback to cookie then final fallback to default currecy
     */
    protected function getCurrency(){
        $urlCurrency = $this->request->get('curr','string');
        $cookieCurrency = $this->cookies->get('curr')->__toString();

        if ($urlCurrency != '') {
            $defaultCurrency = $urlCurrency;

            if ($this->cookies->get('curr')->__toString() != $defaultCurrency) {
                $this->cookies->set('curr', $defaultCurrency, time() + 15 * 86400);
            }

        } elseif($cookieCurrency != '') {
            $defaultCurrency = $cookieCurrency;
        } else{
            $defaultCurrency = SELF::DEFAULT_CURR;
        }
        return $defaultCurrency;
    }

    /**
     * @return mixed|string
     */

    protected function getLocale() {

        $locale = null;
        // check locale on url ex: n/en_AU/sale/asia-deals/
        if ($this->dispatcher->getParam('locale') != null) {

            $locale    = $this->dispatcher->getParam('locale');
        // check locale on get request ex ?locale=en_AU
        } elseif ( $this->request->get('locale','string') != null) {

            $locale    = $this->request->get('locale','string');
        // second priority for cookie
        } elseif ($this->cookies->get('AustinLocale')->__toString() != null) {

            $locale = $this->cookies->get('AustinLocale')->__toString();
         // set default locale
        } else {

            $locale = SELF::DEFAULT_LOCALE;
        }

        return $locale;

    }

    /**
     * @return mixed|null|string
     */

    protected function getUrlLocale() {

        $locale = null;
        // check locale on url ex: n/en_AU/sale/asia-deals/
        if ($this->dispatcher->getParam('locale') != null) {

            $locale    = $this->dispatcher->getParam('locale');
            // check locale on get request ex ?locale=en_AU
        } elseif ( $this->request->get('locale','string') != null) {

            $locale    = $this->request->get('locale','string');
            // second priority for cookie
        }
        return $locale;
    }

    /**
     * @param $content
     * @return array|null
     */
    protected function getContentByScope($content){
        $contentScope = null != $this->city && null != $this->when ? self::CONTENT_SCOPE_DESTINATION : self::CONTENT_SCOPE_HOME;
        $contentScopeDefault = self::CONTENT_SCOPE_DEFAULT;
        $parsedContent = null;

        if(!empty($content) && is_array($content)){

            $parsedContent = !empty($content[$contentScope]) ? $content[$contentScope] : null;

            // If null attempt o extract default scope as fallback
            $parsedContent = null === $parsedContent && !empty($content[$contentScopeDefault]) ? $content[$contentScopeDefault] : $parsedContent;
        } else {
            $parsedContent = '';
        }
        // if parsed is still null but content is not empty then we have content with scope other than home, city or default, get the first one
        if(null === $parsedContent && !empty($content) && is_array($content)){
            $parsedContent = array_values($content)[0];
        }
        return $parsedContent;
    }
}