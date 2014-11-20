<?php

namespace HC\Merch\Controllers;

class IndexController extends ControllerBase {
    protected $uriBase;
    protected $uriFull;
    protected $pageLayout;
    protected $languageCode;
    protected $currencyCode;
    protected $campaignName;
    protected $city;
    protected $country;
    protected $menuTabMain;
    protected $menuTabSub;

    /**
     * @var Users
     */
    protected $user;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var translation
     */
    protected $translation;
    protected $data;
    protected $DDMenue;
    protected $region;
    /**
     * @var \HC\Merch\Models\Page
     */
    private $dataModel;
    private $viewType;
    private $campaignData;
    private $couchData;
    private $docmentPageUrl;
    private $couchPageData;

    public function initialize() {

        //set the view type
        $this->viewType = ($this->request->isPost() == TRUE &&
            $this->request->getPost('returnType') == 'json') ? 'json' : 'html';
        //if requested data type is json then disable view part
        if ($this->viewType == 'json') {
            $this->view->disable();
            $this->dataModel = new \HC\Merch\Models\Page ();
            $this->dataModel->setPageUrl($this->buildDocumentPageUrl());
            $this->dataModel->loadCouchPageDeals();
            die($this->dataModel->pageUrlData);
        }
        $this->setupPage ();
        //$this->view->setVar('theme', $this->getPageLayout() );
        $this->view->setTemplateAfter ( $this->getPageLayout () );
        parent::initialize ();
        //$this->getUserData();
    }

    public function indexAction() {
        $this->region = $this->dataModel->getFirstRegion ();
        if ($this->viewType == 'json') {
            die(json_encode($this->dataModel->getRegionHoteles ( $this->region )));
        }
        $this->view->setVars ( array_merge ( array (
                    "hotels" => $this->dataModel->getRegionHoteles ( $this->region )
                ), $this->buildTemplateVars () ) );
        $this->view->pick ($this->getPageLayout() .'/index/index');
    }

    public function campaignAction() {
        // Routing if unicode exists on parameter
        if (! empty ( $this->dispatcher->getParams ()[0] ) &&
            ! empty ( $this->dispatcher->getParams ()[1] ) &&
            ! empty ( $this->dispatcher->getParams ()[2] )) {

            $this->region = $this->dispatcher->getParams ()[0];
            $this->country = $this->dispatcher->getParams ()[1];
            $this->city = $this->dispatcher->getParams ()[2];
            // forward to city
            $this->dispatcher->forward ( array (
                    'controller' => 'index',
                    'action' => 'city'
                ) );
        } elseif (! empty ( $this->dispatcher->getParams ()[0] ) &&
            ! empty ( $this->dispatcher->getParams ()[1] )) {
            // die('got country');
            $this->region = $this->dispatcher->getParams ()[0];
            $this->country = $this->dispatcher->getParams ()[1];
            // foreard to country
            $this->dispatcher->forward ( array (
                    'controller' => 'index',
                    'action' => 'country'
                ) );
        } elseif (! empty ( $this->dispatcher->getParams ()[0] )) {
            // die('got region');
            $this->region = $this->dispatcher->getParams ()[0];
            // forward to region
            $this->dispatcher->forward ( array (
                    'controller' => 'index',
                    'action' => 'region'
                ) );
        } else {

            $this->region = $this->dataModel->getFirstRegion ();
            if ($this->viewType == 'json') {
                die(json_encode($this->dataModel->getRegionHoteles ( $this->region )));
            }
            $this->view->setVars ( array_merge ( array (
                        "hotels" => $this->dataModel->getRegionHoteles ( $this->region )
                    ), $this->buildTemplateVars () ) );
            $this->view->pick ( $this->getPageLayout() .'/index/index' );
        }
    }

    public function regionAction() {
        $data = array (
            "hotels" => $this->dataModel->getRegionHoteles ( $this->region )
        );
        if ($this->viewType == 'json') {
            die(json_encode($data));
        }
        $this->view->setVars ( array_merge ($data, $this->buildTemplateVars () ) );
        $this->view->pick ($this->getPageLayout() .'/index/index');
    }

    public function countryAction() {
        $data = array (
            "hotels" => $this->dataModel->getCountryHoteles ( $this->region, $this->country ),
            "country" => $this->country
        );
        if ($this->viewType == 'json') {
            die(json_encode($data));
        }
        $this->view->setVars ( array_merge ( $data, $this->buildTemplateVars () ) );
        $this->view->pick ($this->getPageLayout() .'/index/index');
    }

    public function cityAction() {
        $data = array (
            "hotels" => $this->dataModel->getCityHoteles ( $this->region, $this->country, $this->city ),
            "country" => $this->country,
            "city" => $this->city
        );
        if ($this->viewType == 'json') {
            die(json_encode($data));
        }
        $this->view->setVars ( array_merge ($data, $this->buildTemplateVars ()));
        $this->view->pick ($this->getPageLayout() .'/index/index');
    }

    public function setLanguageAction() {
        // Store user selected language to cookies
        //setcookie('AustinLocale', $this->languageCode);
        $this->cookies->set ( 'AustinLocale', $this->languageCode );
        $this->response->redirect ( 'merch/' . $this->languageCode . '/' . $this->campaignName );
    }


    public function setCurrencyAction() {
        $this->cookies->set ( 'curr', $this->currencyCode );
        $this->response->redirect ( 'merch/' . $this->languageCode . '/' . $this->campaignName );
    }

    /**
     * @return mixed
     */
    public function getCampaignName()
    {
        if(null === $this->campaignName){
            $this->setCampaignName();
        }
        return $this->campaignName;
    }

    /**
     * @param mixed $campaignName
     */
    public function setCampaignName($campaignName = null)
    {
        $campaignName = $this->dispatcher->getParam ( "campaignName" );
        if(null === $campaignName){
            $campaignName = $this->dataModel->getCampaignName();
        }
        $this->campaignName = $campaignName;
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
        $country = null === $country ? $this->dispatcher->getParam ( "countryName" ) : $country;
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        if(null === $this->currencyCode){
            $this->setCurrencyCode();
        }
        return $this->currencyCode;
    }

    /**
     * @param mixed $currencyCode
     */
    public function setCurrencyCode($currencyCode = null)
    {
        // inverstigate what query parma 'cr' is meant for, do we need to factor this in?
        $this->currencyCode = $currencyCode;
        if(null === $this->currencyCode){

            $dispatcherValue = $this->dispatcher->getParam("curr");
            $dispatcherValue = !empty($dispatcherValue) && $this->isValidCurrency($dispatcherValue) ? $dispatcherValue : null;
            $cookieValue = $this->cookies->has ( 'curr' ) ? $this->cookies->get('curr')->__toString() : null;

            $currencyCode = null !== $dispatcherValue ? $dispatcherValue : null;
            $currencyCode = null === $currencyCode ? $cookieValue : $currencyCode;
            $currencyCode = null === $currencyCode ? $this->dataModel->getCurrency() : $currencyCode;
            $this->cookies->set('curr', $currencyCode);
            $this->currencyCode = $currencyCode;

        }
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
     * @param mixed $city
     */
    public function setCity($city = null)
    {
        $city = null === $city ? $this->dispatcher->getParam ( "cityName" ) : $city;
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        if(null === $this->languageCode){
            $this->setLanguageCode();
        }
        return $this->languageCode;
    }

    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode = null)
    {
        // Set from url param
        $languageCode = null === $languageCode ? $this->dispatcher->getParam ( "languageCode" ) : $languageCode;
        $languageCode = null === $languageCode && $this->cookies->has('AustinLocale') ? $this->cookies->get('AustinLocale')->__toString() : $languageCode;
        $languageCode = null === $languageCode ? $this->dataModel->getLanguageCode() : $languageCode;

        $this->languageCode = $languageCode;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        if(null === $this->region){
            $this->setCountry();
        }
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region = null)
    {
        $region = null === $region ? $this->dispatcher->getParam ( "regionName" ) : $region;
        $this->region = $region;

        /*        if(null === $this->region){
                    $dispatcherValue = $this->dispatcher->getParam("regionName");
                    $cookieValue = $this->cookies->has ( 'regionName' ) ? $this->cookies->get('regionName')->__toString() : null;

                    $region = null !== $dispatcherValue ? $dispatcherValue : null;
                    $region = null === $region ? $cookieValue : $region;
                    $region = null === $region ? $this->dataModel->getRegion() : $region;
                    $this->cookies->set('regionName', $region);
                    $this->region = $region;

                }*/
        return $this;

    }

    /**
     * Setting page data
     */
    protected function setupPage() {
        // Setup data for the page
        /** @var \HC\Merch\Models\Page dataModel */
        $this->dataModel = new \HC\Merch\Models\Page();

        // setting class variable
        $this->setInputvars ();

        // add checker
        $this->dataModel->setCampaignName($this->campaignName)
            ->setRegion($this->region)
            ->setLanguageCode($this->languageCode );
        $this->dataModel->setPageUrl($this->buildDocumentPageUrl());
        $this->dataModel->init();

        // Check campaign
        $this->validateCampaign ();

        // Validate language
        //$this->validateLanguage ();

        // set menu data
        $this->menu = $this->dataModel->menuData;
        // set Drop-down menu

        $this->couchData = str_replace("'", "&#154;", json_encode($this->dataModel->dealsData));
        \Phalcon\Tag::setTitle ( $this->dataModel->dealsData['meta']['name'] );

        $this->couchPageData = $this->dataModel->pageUrlData;
        // set translation obj
        $this->translation = new \HC\Library\Translation ( $this->languageCode, $this->dataModel->langData );
        // set site url
        $this->uriFull = $this->router->getRewriteUri();
        // set uri base
        $this->uriBase = $this->getBaseUrl ();
        $var = $this->dispatcher->getParams();

    }

    /**
     * Set Input data to properties
     */
    public function setInputvars() {
        $this->setCampaignName();
        $this->setLanguageCode();
        $this->setCurrencyCode();
        $this->setRegion();
        $this->setCountry();
        $this->setCity();
    }

    private function buildDocumentPageUrl() {
        $url = '';
        if (!empty($this->dispatcher->getParams()['campaignName'])) {
            $url .= $this->dispatcher->getParams()['campaignName'];
        }
        if (!empty($this->dispatcher->getParams()['regionName'])) {
            $url .= '/'.$this->dispatcher->getParams()['regionName'];
        }
        if (!empty($this->dispatcher->getParams()['countryName'])) {
            $url .= '/'.$this->dispatcher->getParams()['countryName'];
        }
        if (!empty($this->dispatcher->getParams()['cityName'])) {
            $url .= '/'.$this->dispatcher->getParams()['cityName'];
        }
        return $url;
    }

    private function isValidCurrency($cCode) {
        foreach($this->config->currencies->toArray() as $label => $curr) {
            if (array_key_exists($cCode, $curr))
                return TRUE;
            else
                return FALSE;
        }
    }

    /**
     * If Campaign document doesn't exists, checkout the default campaign and redirect it
     * If default campaign does not exists, load 404 page
     */
    private function validateCampaign() {
        if ($this->dataModel->dealsData == NULL) {

            if ($this->dataModel->isValidDefaultCampaign ())
                $this->response->redirect ( 'merch/' . \HC\Merch\Models\Page::DEFAULT_PAGE_LANG . '/' . \HC\Merch\Models\Page::DEFAULT_PAGE_CAMPAIGN );
            else
                $this->dispatcher->forward ( array (
                        'controller' => 'index',
                        'action' => 'show404'
                    ) );
        }
    }

    private function isThemeExists($name) {
        if (array_key_exists($name, $this->config->themes->toArray()))
            return true;
        else
            return false;
    }

    /**
     * If language document doesn't exists, take default language and redirect with same requested parameter
     * If default lang doesn't exists display it same
     */
    private function validateLanguage() {
        if ($this->dataModel->isLanguageExists () == FALSE) {
            if ($this->dataModel->setDefaultLang ()) {
                $url = 'merch/' . \HC\Merch\Models\Page::DEFAULT_PAGE_LANG . '/' . $this->campaignName;
                if ($this->region != null)
                    $url .= '/' . $this->region;
                if ($this->country != null)
                    $url .= '/' . $this->country;
                if ($this->city != null)
                    $url .= '/' . $this->city;

                // redirect to same url
                $this->response->redirect ( $url );
            }
        }
    }

    private function buildTemplateVars() {
        return array (
            'data' => $this->couchData,
            'urlPData' => $this->couchPageData,
            'theme' => $this->getPageLayout (),
            'uriBase' => $this->uriBase,
            'uriFull' => $this->uriFull,
            'languageCode' => $this->languageCode,
            'currencyCode' => $this->currencyCode,
            'menuItemsTop' => $this->menu->top,
            'menuItemsSite' => $this->menu->site,
            'menuItemsLanguageOptions' => ( array ) $this->menu->languageOptions,
            'currencies' => $this->config->currencies->toArray(),
            'currencyList' => $this->getCurrencyListByGroup(),
            'menuItemsRightSite' => $this->menu->rightSite,
            'menuItemsAccount' => $this->menu->account,
            "t" => $this->translation->getTranslation (),
            'banners' => $this->dataModel->getBanner ( $this->campaignName ),
            "campaignName" => $this->campaignName,
            'DDMenue' => $this->DDMenue,
            'campaignData' => json_encode($this->campaignData),
            "hotelDetails" => $this->dataModel->loadHotelData (),
            "hotelDetailsJson" => json_encode($this->dataModel->loadHotelData ()),
            "region" => $this->region,
            "country" => $this->country,
            "city" => $this->city,
        );
    }

    protected function getCurrencyListByGroup(){
        $currencyGroup = $this->config->currencyGroup->toArray();
        $currencies = $this->config->currencies->toArray();
        foreach($currencyGroup as $index => $group){
            foreach($group as $currencyCategory ){
                $currencyList[$index][ucfirst(str_replace('-',' ',$currencyCategory))] = $currencies[$currencyCategory];
            }
        }
        return $currencyList;
    }

    protected function getPageLayout() {

        if (!empty($this->request->getQuery('thm')) && $this->isThemeExists($this->request->getQuery('thm'))) {

            return $this->request->getQuery('thm');
        } elseif (isset($this->dataModel->dealsData['meta']['layout']) && !empty($this->dataModel->dealsData['meta']['layout']))

            return $this->dataModel->dealsData['meta']['layout'];
        else
            return \HC\Merch\Models\Page::DEFAULT_PAGE_LAYOUT;
    }

    protected function getBaseUrl() {
        return '/merch/' . $this->languageCode . '/' . $this->campaignName;
    }

    private function redirectToDefaultPage() {
        return $this->response->redirect ( 'merch/' . \HC\Merch\Models\Page::DEFAULT_PAGE_LANG . '/' . \HC\Merch\Models\Page::DEFAULT_PAGE_CAMPAIGN );
    }

    /**
     * Get location fron hotelclub
     * passing value to 'searchedText'
     */
    public function getLocationAction() {
        ob_start ( null, 0, false );
        if ($this->request->get ( "q" ) != NULL) {
            header ( 'Content-type: application/json; charset=utf-8' );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, "http://www.hotelclub.com/helper/hotelSmartfill" );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, 'searchedText=' . trim ( $this->request->get ( "q" ) ) );
            $var = curl_exec ( $ch );
            curl_close ( $ch );
        }
        die ();
    }

    public function show404Action() {
        //echo ('testing hhere');
        $this->view->setVars ( $this->buildTemplateVars () );
        $this->view->pick ( $this->getPageLayout() .'/index/404' );
    }



    public function getUserData() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://www.hotelclub.com/info/cookiePrinter');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/html"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_POST, 0);
        $data = curl_exec($ch);


        //$html = new \simple_html_dom();
        //$html->load($html);
        //$rs = $html->find('a');
        print_r($data);

        $html = new \simple_html_dom();
        $html->load($data);
        echo "<pre>";
        $eles = $html->find('*');		//var_dump($eles);
        foreach($eles as $e) {
            //echo $e->outertext;
            print_r($e->innertext);
            if(strpos($e->innertext, 'Remote address') !== false) {
                echo '*************************';
                print_r($e->dump_node());
                echo '***********************************************';
                //print_r($e->dump);
                print_r(get_class_methods($e));
            }
        }
        die();
    }
}