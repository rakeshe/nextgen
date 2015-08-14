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

    private $cityData;

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

    private $uri;

    public function initialize() {

        $this->init();

        if ($this->request->isPost() && $this->request->isAjax()) {
            $data = [];
            $hotelData = $this->model->getHotels(
                $this->request->getPost('region', 'string'),
                $this->request->getPost('city', 'string'),
                $this->request->getPost('when', 'string')
            );
            $data['hData'] = json_decode($hotelData, true);

            $currDoc = $this->model->getCurrencyDocument(DealsModel::DEALS_CURRENCY_DOC_NAME,
                $this->request->getPost('curr', 'string'));

            $data['currData'] = json_decode($currDoc, true);

            die(json_encode($data));
        }

        if (NULL !== $this->userId)
            $this->setUserInfo();

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


    public function init() {

        $this->model = new \HC\Deals\Models\DealsModel();

        $this->setParams();
    }

    private function setParams() {

       // var_dump($this->dispatcher->getParams());
        //var_dump($this->request->get()); exit;

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
        if (preg_match("/^[a-z]{2}+_[A-Z]{2}+$/" , $uris[1]) && array_key_exists($uris[1], $this->config->languageOptions)) {
            $this->locale = $uris[1];
            $this->uri = $this->locale .'/'. self::DEFAULT_URI;
        } else {
            $this->locale = SELF::DEFAULT_LOCALE;
            $this->uri = self::DEFAULT_URI;
        }
        // Set locale in model
        $this->model->setLocale($this->locale);

    }

    public function indexAction() {

        $this->cityData = $this->model->getCityDocument();

        // Check: if cityData is null, then get cityDocument for default locale and override locale in model
        if($this->cityData === '{}'){
            $this->model->setLocale(DealsModel::DEFAULT_LOCALE);
            $this->cityData = $this->model->getCityDocument();
        }

        $noHotels = 'false';
        if ($this->city !== NULL && $this->when !== NULL) {
            $this->hotels = $this->model->getHotels('', $this->city, $this->when);

            if ($this->hotels == '{}') {
                $noHotels = 'true';
            }

        } else {
            $this->hotels = '{}';
        }

        // Add Webtrends tracking
        $webTrends = new \HC\Common\Helpers\WebtrendsHelper();

        // Get Cms Documents
        $docFooterSeo =  $this->model->getCmsDocument(DealsModel::DOC_NAME_FOOTER_SEO_LINKS, true);
        $docFooterAbout = $this->model->getCmsDocument(DealsModel::DOC_NAME_FOOTER_ABOUT, true);
        $docHtmlHead = $this->model->getCmsDocument(DealsModel::DOC_HTML_HEAD, true);
        $docHtmlBodyStart = $this->model->getCmsDocument(DealsModel::DOC_HTML_BODY_START, true);
        $docHtmlBodyEnd = $this->model->getCmsDocument(DealsModel::DOC_HTML_BODY_END, true);

        $heroImage = ($this->model->getCmsDocument(DealsModel::HEROES_IMAGE_DOC_NAME)) == false ? '{}'
            : $this->model->getCmsDocument(DealsModel::HEROES_IMAGE_DOC_NAME);

        $trans = ($this->model->getCmsDocument(DealsModel::DEALS_TRANSLATION_DOC_NAME)) == false ? '{}'
            : $this->model->getCmsDocument(DealsModel::DEALS_TRANSLATION_DOC_NAME);

        $currDoc = $this->model->getCurrencyDocument(DealsModel::DEALS_CURRENCY_DOC_NAME, $this->currency);


        $this->view->setVars(
            [
                'appVersion'          => APPLICATION_VERSION,
                'cityData'            => $this->cityData,
                'promoCardData'       => $this->model->getPromoCardDoc(),
                'city'                => $this->city,
                'when'                => $this->when,
                'sort'                => $this->sort,
                'appendURL'           => $this->appendURL,
                'url'                 => $this->uri,
                'hData'               => $this->hotels,
                'userInfo'            => json_encode($this->userInfo),
                'wtMetaData'          => $webTrends
                    ->setOwwPage($this->router->getRewriteUri())
                    ->getWtMetaData(),
                'wtDataCollectorData' => $webTrends->getWtDataCollectorData(),
                'clubPromo'       => $this->model->getCmsDocument(DealsModel::PROMOTIONS_CLUB_DOC_NAME),
                'pmPromo'         => $this->model->getCmsDocument(DealsModel::PROMOTIONS_PM_DOC_NAME),
                'docFooterSeo'        => $docFooterSeo->html,
                'docFooterAbout'      => $docFooterAbout->html,
                'sortBy'              => $this->sortBy,
                'sortType'            => $this->sortType,
                'noHotels'            => $noHotels,
                'heroImages'          => $heroImage,
                'docHtmlHead'         => !empty($docHtmlHead->html) ? $docHtmlHead->html : '',
                'docHtmlBodyStart'    => !empty($docHtmlBodyStart->html) ? $docHtmlBodyStart->html : '',
                'docHtmlBodyEnd'      => !empty($docHtmlBodyEnd->html) ? $docHtmlBodyEnd->html : '',
                'translation'         => $trans,
                'currenciesData'      => json_encode($this->config->currencies),
                'localeData'          => json_encode($this->config->languageOptions),
                'curr'                => $this->currency,
                'locale'              => $this->locale,
                'currDoc'             => $currDoc
            ]
        );

        $this->view->pick('default/index/index');
    }

    protected function getWtMetaData(){
        return [
            'DCSext.LNG' => null === $this->languageCode ? 'en_AU' : $this->languageCode ,
            'DCSext.pos' => 'HCL',
            'DCSext.hostname' => 'www.hotelclub.com',
            'DCSext.owwPage' =>  $this->router->getRewriteUri()
        ];

    }

    public function show404Action() {
        $this->dispatcher->forward(array(
                'controller' => 'deals',
                'action' => 'index'
            ));
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