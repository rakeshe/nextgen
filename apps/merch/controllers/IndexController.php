<?php
namespace HC\Merch\Controllers;
class IndexController extends ControllerBase
{

    protected $uriBase;
    protected $uriFull;
    protected $pageLayout;
    protected $languageCode;
    protected $campaignName;
    protected $city;
    protected $country;
    protected $menuTabMain;
    protected $menuTabSub;

    /** @var  Users */
    protected $user;

    /** @var Menu */
    protected $menu;

    /** @var  translation */
    protected $translation;
    protected $data;
    protected $DDMenue;
    protected $region;
    private   $dataModel;
    
    public function initialize()
    {
        $this->view->setTemplateAfter($this->getPageLayout());
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
        $this->setupPage();
        
    }    

    public function indexAction()
    {   
        $this->region = $this->dataModel->getFirstRegion();
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getRegionHoteles(
                    $this->region
                    )),
                    $this->buildTemplateVars()
        ));        
        $this->view->pick('index/page');
    }

    public function campaignAction()
    {
        //Routing if unicode exists on parameter
        if (!empty($this->dispatcher->getParams()[0]) && !empty($this->dispatcher->getParams()[1]) && 
                !empty($this->dispatcher->getParams()[2])) {
            
            $this->region   = $this->dispatcher->getParams()[0];
            $this->country  = $this->dispatcher->getParams()[1];
            $this->city     = $this->dispatcher->getParams()[2];
            //forward to city
            $this->dispatcher->forward(array('controller' => 'index', 'action' => 'city'));
        } elseif (!empty($this->dispatcher->getParams()[0]) && !empty($this->dispatcher->getParams()[1])) {
            //die('got country');
            $this->region   = $this->dispatcher->getParams()[0];
            $this->country  = $this->dispatcher->getParams()[1];
            //foreard to country
            $this->dispatcher->forward(array('controller' => 'index', 'action' => 'country'));
        } elseif (!empty($this->dispatcher->getParams()[0])) {
            //die('got region');
            $this->region   = $this->dispatcher->getParams()[0];
            //forward to region
            $this->dispatcher->forward(array('controller' => 'index', 'action' => 'region'));
        }
         
        $this->region = $this->dataModel->getFirstRegion();
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getRegionHoteles(
                    $this->region
                    )),
                    $this->buildTemplateVars()
        ));      
        $this->view->pick('index/page');
    }
    
    public function regionAction() {        
        
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getRegionHoteles($this->region)),
                    $this->buildTemplateVars()
        ));    
        $this->view->pick('index/page');
    }   
    
    public function countryAction() {
        
        $this->view->setVars(
            array_merge(array (
                "hotels" => $this->dataModel->getCountryHoteles(
                        $this->region, $this->country),
                "country" => $this->country
                ),
                    $this->buildTemplateVars()
        ));        
        $this->view->pick('index/page');
    }


    public function cityAction() {
        $this->view->setVars(
            array_merge(array (
                "hotels" => $this->dataModel->getCityHoteles(
                        $this->region, $this->country, $this->city
                    ),
                "country" => $this->country,
                "city" => $this->city
                ),
                    $this->buildTemplateVars()
        ));        
        
        $this->view->pick('index/page');
    }   
    
    public function setLanguageAction() {
        //Store user selected language to session
        $this->session->set('languageCode', $this->languageCode);
        $this->response->redirect('merch/'. $this->languageCode. '/'. $this->campaignName);
    }
    
    /**
     * Setting page data
     */
    protected function setupPage()
    {
        //setting class variable
        $this->setInputvars();
        // Setup data for the page
        $this->dataModel = new \HC\Merch\Models\Page();
        $this->dataModel
                ->setCampaignName($this->campaignName)
                ->setRegion($this->region)
                ->setLanguageCode($this->languageCode)
                ->init();
        
        //Check campaign
        $this->validateCampaign();
        
        //Validate language
        $this->validateLanguage();
        
        //set menu data
        $this->menu = $this->dataModel->menuData;        
        //set Drop-down menu
        $this->DDMenue  = $this->dataModel->loadCampaignData();       
        //set translation obj        
        $this->translation  = new \HC\Library\Translation($this->languageCode,
                $this->dataModel->langData);        
        //set site url
        $this->uriFull = $this->router->getRewriteUri();   
        //set uri base
        $this->uriBase = $this->getBaseUrl();        
    }
    
    /**
     * Set Input data to properties
     */    
    public function setInputvars() {
        
        $this->campaignName = (null == $this->dispatcher->getParam("campaignName")) ? 
                \HC\Merch\Models\Page::DEFAULT_PAGE_CAMPAIGN : $this->dispatcher->getParam("campaignName");
       
        $this->languageCode = (null == $this->dispatcher->getParam("languageCode")) ?
                (!$this->session->has('languageCode')) ? \HC\Merch\Models\Page::DEFAULT_PAGE_LANG : $this->session->get('languageCode')
                : $this->dispatcher->getParam("languageCode");
        
        $this->region = (null == $this->dispatcher->getParam("regionName")) ? NULL :
                $this->dispatcher->getParam("regionName");                
        
        $this->country = (null == $this->dispatcher->getParam("countryName")) ? null :
                $this->dispatcher->getParam("countryName");
        
        $this->city = (null == $this->dispatcher->getParam("cityName")) ? null : 
                $this->dispatcher->getParam("cityName");
    }
    
    /**
     * If Campaign document doesn't exists, checkout the default campaign and redirect it
     * If default campaign does not exists, load 404 page
     */
    
    private function validateCampaign() {       
       
        if ($this->dataModel->dealsData == NULL) {
            
            if ($this->dataModel->isValidDefaultCampaign())
                $this->response->redirect('merch/'. \HC\Merch\Models\Page::DEFAULT_PAGE_LANG. '/'. 
                        \HC\Merch\Models\Page::DEFAULT_PAGE_CAMPAIGN);
            else       
                $this->dispatcher->forward(array('controller' => 'index', 'action' => 'show404'));
         }
    }

    /**
     * If language document doesn't exists, take default language and redirect with same requested parameter
     * If default lang doesn't exists display it same
     */
    private function validateLanguage() {
        
        if ($this->dataModel->isLanguageExists() == FALSE) {
            if ($this->dataModel->setDefaultLang()) {
                $url = 'merch/'. \HC\Merch\Models\Page::DEFAULT_PAGE_LANG. '/'. $this->campaignName;
                if ($this->region != null)
                    $url .= '/' . $this->region;
                if ($this->country != null)
                    $url .= '/' . $this->country;
                if ($this->city != null)
                    $url .= '/' . $this->city;
                        
                //redirect to same url
                $this->response->redirect($url);
            }            
        }
    }   
    
    private function buildTemplateVars() {
       return array(
                'pageLayout'               => $this->getPageLayout(),
                'uriBase'                  => $this->uriBase,
                'uriFull'                  => $this->uriFull,
                'languageCode'             => $this->languageCode,               
                'menuItemsTop'             => $this->menu->top,
                'menuItemsSite'            => $this->menu->site,
                'menuItemsLanguageOptions' => (array) $this->menu->languageOptions,
                'menuItemsRightSite'       => $this->menu->rightSite,
                'menuItemsAccount'         => $this->menu->account,
                "t"                        => $this->translation->getTranslation(),
                'banners'                  => $this->dataModel->getBanner($this->campaignName),
                'DDMenue'                  => $this->DDMenue,
                "hotelDetails"             => $this->dataModel->loadHotelData(),
                "region"                   => $this->region
            );
        
    }    

    protected function getPageLayout(){
        if(empty($this->data['meta']['pageLayout'])){
            // use session if avail
            return \HC\Merch\Models\Page::DEFAULT_PAGE_LAYOUT;
        }
    }
    
    protected function getBaseUrl() {
        return '/merch/' . $this->languageCode . '/' . $this->campaignName;
    }
    
    private function redirectToDefaultPage() {
        return $this->response->redirect('merch/'. \HC\Merch\Models\Page::DEFAULT_PAGE_LANG. '/'. \HC\Merch\Models\Page::DEFAULT_PAGE_CAMPAIGN);
    }
    
    /**
     * Get location fron hotelclub
     * passing  value to 'searchedText'
     */
       
    public function getLocationAction() {
        
        if (!empty($this->request->get("q"))) {
            header('Content-type: application/json');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://www.hotelclub.com/helper/hotelSmartfill");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'searchedText=' . trim($this->request->get("q")));
            $var = curl_exec ($ch);        
            curl_close ($ch);            
        }
        die();
    }    
    
    public function show404Action() {
        
        $this->view->setVars(
                $this->buildTemplateVars()
                ); 
       $this->view->pick('404/404');
    }
        
}