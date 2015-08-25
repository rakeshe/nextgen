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
        } else {
            $this->locale = SELF::DEFAULT_LOCALE;
        }
    }

    public function indexAction() {


        // dev:sale:773417b30e69f2511c9afda61c8d936e:city_list:en_au
        // dev:sale:773417b30e69f2511c9afda61c8d936e:city_list:zh_cn
        $cityList = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['city_list'] )
        );

        // dev:sale:773417b30e69f2511c9afda61c8d936e:footer_seo:en_au
        // dev:sale:773417b30e69f2511c9afda61c8d936e:footer_seo:zh_cn
        $docFooterSeo =  $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['footer_seo'], true )
        );
        $docFooterSeo = json_decode($docFooterSeo);

        $docFooterAbout = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['footer_about'], true )
        );
        $docFooterAbout = json_decode($docFooterAbout);

        $docHtmlHead = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_head'], true )
        );
        $docHtmlHead = json_decode($docHtmlHead);

        $docHtmlBodyStart = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_body_start'], true )
        );
        $docHtmlBodyStart = json_decode($docHtmlBodyStart);

        $docHtmlBodyEnd = $this->model->getDocument(
            $this->model->buildUrl( $this->model->campaignDocNames['html_body_end'], true )
        );
        $docHtmlBodyEnd = json_decode($docHtmlBodyEnd);

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
                'docFooterSeo'        => !empty($docFooterSeo->html) ? $docFooterSeo->html : '',
                'docFooterAbout'      => !empty($docFooterAbout->html) ? $docFooterAbout->html : '',
                'docHtmlHead'         => !empty($docHtmlHead->html) ? $docHtmlHead->html : '',
                'docHtmlBodyStart'    => !empty($docHtmlBodyStart->html) ? $docHtmlBodyStart->html : '',
                'docHtmlBodyEnd'      => !empty($docHtmlBodyEnd->html) ? $docHtmlBodyEnd->html : '',
                'translation'         => $trans,
                'currenciesData'      => json_encode($this->config->currencies),
                'localeData'          => json_encode($this->config->languageOptions),
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
        $urlCurrency = $this->request->get('curr','string');
        $cookieCurrency = $this->cookies->get('curr')->__toString();

        if ($urlCurrency != '') {
            $defaultCurrency = $urlCurrency;
        } elseif($cookieCurrency != '' ){
            $defaultCurrency = $cookieCurrency;
        } else{
            $defaultCurrency = SELF::DEFAULT_CURR;
        }
        return $defaultCurrency;
    }
}