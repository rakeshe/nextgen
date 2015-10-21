<?php

/**
 *
 * @package    DealsController.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Controllers;

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

        $this->model = new \HC\Deals\Models\DealsModel();
        $this->setParams();

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

        if (false == $this->masterData ) {
            $this->dispatcher->forward([
                'controller' => 'deals',
                'action' => 'show404',
            ]);

        } else if ($this->campaignName == null ||
            array_key_exists($this->campaignName, $this->masterData['data']) == false) {
          //No campaign name by that name so load up default campaing as set in master doc
            $this->dispatcher->forward(
                [
                    'controller' => 'deals',
                    'action'     => 'index',
                    'params'     => ['campaignName' => $this->getFallBackDefaultCampaign()]
                ]
            );

        }
    }

    private function setParams() {
        if ($this->dispatcher->getParam('campaignName') !== null) {
            $this->campaignName = $this->dispatcher->getParam('campaignName');
        }
        $this->model->setDocumentNames();
        $this->masterData = $this->model->getDocument( $this->model->masterDocName, true );

        // Get Ip and get default options for that country
        $clientIp = $this->request->getClientAddress();

        // Check if ip sent over url param (for test only)
        if(ORBITZ_ENV == 'dev' || ORBITZ_ENV == 'fqa1') {
            $clientIp = !empty($this->request->get()['ip']) ? $this->request->get()['ip'] : $clientIp;
        }

        $this->model->setClientIp($clientIp);
        $this->model->setupClientLocationOptions();

        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[0])) {
            $this->city = str_replace('#','',$this->dispatcher->getParams()[0]);
            $this->appendURL .= $this->city . '/';
        } else {
            // set city/ append url based on ip if campaign =1
            if( !$this->isCampaignHasLanding()){
                $this->city =  $this->model->getClientDefaultCity();
                $this->appendURL .= $this->city . '/';
            }

        }


        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[1])) {
            $this->when = $this->dispatcher->getParams()[1];
            $this->appendURL .= $this->when;
        } else {
            // set when/ append url based on ip if campaign =1
            if( !$this->isCampaignHasLanding()){
                $this->when = self::DEFAULT_WHEN;
                $this->appendURL .= self::DEFAULT_WHEN;
            }
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
        $this->locale = $this->getLocale();

    }


    public function indexAction() {
        // dev:sale:773417b30e69f2511c9afda61c8d936e:city_list:en_au
        // dev:sale:773417b30e69f2511c9afda61c8d936e:city_list:zh_cn
        $cityList = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['city_list'] )
        );

        // If cityList is null then selected locale is not supported for this campaign, therefore fall back to default locale
        if(!$cityList){
            $this->locale= DealsModel::DEFAULT_LOCALE;
            $this->model->setLocale(DealsModel::DEFAULT_LOCALE);
            //Also set cookie
            $this->cookies->set('AustinLocale',$this->locale);
            $cityList = $this->model->getDocument(
                $this->model->buildUrl( $this->model->campaignDocNames['city_list'] )
            );
        }

        // dev:sale:773417b30e69f2511c9afda61c8d936e:footer_seo:en_au
        // dev:sale:773417b30e69f2511c9afda61c8d936e:footer_seo:zh_cn
        $docFooterSeo =  $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['footer_seo'] ), true
        );
//        $docFooterSeo = json_decode($docFooterSeo);

        $docSeo =  $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['seo'] ) );

        $docFooterAbout = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['footer_about'] ), true
        );
//        $docFooterAbout = json_decode($docFooterAbout);

        $docHtmlHead = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_head'] ), true
        );
//        $docHtmlHead = json_decode($docHtmlHead);

        $docHtmlBodyStart = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_body_start'] ), true
        );
//        $docHtmlBodyStart = json_decode($docHtmlBodyStart);

        $docHtmlBodyEnd = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_body_end'] ), true
        );
//        $docHtmlBodyEnd = json_decode($docHtmlBodyEnd);

        // dev:sale:773417b30e69f2511c9afda61c8d936e:hero_images:en_au
        // dev:sale:773417b30e69f2511c9afda61c8d936e:hero_images:zh_cn
        $heroImage = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['hero_images'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:translation:en_au
        $trans = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['translation'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:currency:aud
        $currDoc = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['currency'], 'currency')
        );

        $clubPromo = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['promo_club'])
        );

        $pmPromo = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['promo_pm'])
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:homepage:en_au
        $homePage = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['homepage'])
        );

        $noHotels = '';
        $dealsData = false;

        if (null != $this->city && null != $this->when) {
            $dealsData = $this->model->getDocument( $this->model->buildDealsUrl( $this->city, $this->when ) );

            if (false == $dealsData) {
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
                'cityData'            => $cityList,
                'homePageData'        => $homePage,
                'city'                => $this->city,
                'when'                => $this->when,
                'sort'                => $this->sort,
                'appendURL'           => $this->appendURL,
                'url'                 => $this->buildSiteUrl(),
                'hData'               => $dealsData,
                'userInfo'            => json_encode($this->userInfo),
                'wtMetaData'          => $webTrends
                    ->setOwwPage($this->router->getRewriteUri())
                    ->getWtMetaData(),
                'wtDataCollectorData' => $webTrends->getWtDataCollectorData(),
                'clubPromo'           => $clubPromo,
                'pmPromo'             => $pmPromo,
                'sortBy'              => $this->sortBy,
                'sortType'            => $this->sortType,
                'noHotels'            => $noHotels,
                'heroImages'          => $heroImage,
                'docFooterSeo'        => $this->getContentByScope($docFooterSeo),
                'docFooterAbout'      => $this->getContentByScope($docFooterAbout),
                'docHtmlHead'         => $this->getContentByScope($docHtmlHead),
                'docHtmlBodyStart'    => $this->getContentByScope($docHtmlBodyStart),
                'docHtmlBodyEnd'      => $this->getContentByScope($docHtmlBodyEnd),
                'docSeo'              => $docSeo,
                'translation'         => $trans,
                'currenciesData'      => json_encode($c),
                'localeData'          => json_encode($l),
                'curr'                => $this->currency,
                'locale'              => $this->locale,
                'currDoc'             => $currDoc,
                'campaignName'        => $this->campaignName,
                'dFormat'             => $dateFormat,
                'dFormatPl'           => $dateFormatPlaceHolder,
            ]
        );

        $this->view->pick('default/index/index');
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
        $defaultCurrency = self::DEFAULT_CURR;
        $urlCurrency = $this->request->get('curr','string');
        $cookieCurrency = $this->cookies->get('curr')->__toString();

        if ($urlCurrency != '') {
            $defaultCurrency = $urlCurrency;
        } elseif($cookieCurrency != '' ){
            $defaultCurrency = $cookieCurrency;
        } else{
            $defaultCurrency = $this->model->getClientDefaultCurrency();
        }

        //Also set cookie
        $this->cookies->set('curr',$defaultCurrency);
        return $defaultCurrency;
    }


    protected function getLocale(){
        $locale = self::DEFAULT_LOCALE;
        $ipLocale =     $this->model->getClientDefaultLocale();
        $urlParamLocale = $this->request->get('locale','string');
        $cookieLocale = $this->cookies->get('AustinLocale')->__toString();
        $uris = explode( '/',$this->router->getRewriteUri()) ;
        $uriLocale = null;
        // detect locale based on url
        if (preg_match("/^[a-z]{2}+_[A-Z]{2}+$/" , $uris[2]) && array_key_exists($uris[2],
                $this->config->languageOptions)) {

            $uriLocale = $uris[2];
        }

        $locale = empty($ipLocale) ? $locale : $ipLocale;
        $locale = empty($cookieLocale) ? $locale : $cookieLocale;
        $locale = empty($uriLocale) ? $locale : $uriLocale;
        $locale = empty($urlParamLocale) ? $locale : $urlParamLocale;

        //Also set cookie
        $this->cookies->set('AustinLocale',$locale);

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

    /**
     * @return bool
     */
    protected function isCampaignHasLanding(){
        if(null !== $this->campaignName && !empty($this->masterData['data'][$this->campaignName])){
            $campaignData = $this->masterData['data'][$this->campaignName];
            return $campaignData['show_landing'] === '1' ? true : false;
        }

    }

    /**
     * @return bool
     */
    protected function isDefaultCampaign(){
        return $this->campaignName === \HC\Deals\Models\DealsModel::DEFAULT_CAMPAIGN_NAME;
    }

    protected function getFallBackDefaultCampaign(){
        if(!empty($this->masterData['data'])){
            foreach($this->masterData['data'] as $campaignName => $campaignData){
                if($campaignData['is_default'] === '1') return $campaignName;
            }
        }
    }
}