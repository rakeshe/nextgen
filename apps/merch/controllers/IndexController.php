<?php
namespace HC\Merch\Controllers;
class IndexController extends ControllerBase
{

    const DEFAULT_PAGE_CAMPAIGN = 'Summer-Escape';    
    const DEFAULT_PAGE_LANG = 'en_AU';
    const DEFAULT_PAGE_LAYOUT = 'main';
    const DEFAULT_PAGE_REGION = 'Pacific';
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
        $this->campaignFileCheck();
    }    

    public function indexAction()
    {              
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getDefaultHoteles()),
                    $this->buildTemplateVars()
        ));        
        $this->view->pick('index/page');
    }

    public function pageAction()
    {  
        /*
        if (!empty($this->dispatcher->getParams()[0]) && !empty($this->dispatcher->getParams()[1]) && 
                !empty($this->dispatcher->getParams()[2])) {
            die('got city');
        } elseif (!empty($this->dispatcher->getParams()[0]) && !empty($this->dispatcher->getParams()[1])) {
            die('got country');
        } elseif (!empty($this->dispatcher->getParams()[0])) {
            die('got region');
        }
         * */
         
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getCampaignDefaultHotels($this->region)),
                    $this->buildTemplateVars()
        ));         
    }
    
    public function regionAction() {        
        
        //if invalid region
        if ($this->dataModel->getDataByRegion($this->region) == FALSE) {            
            $this->redirectToDefaultPage();
        }
        
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getRegionDefaultHotels($this->region)),
                    $this->buildTemplateVars()
        ));    
        $this->view->pick('index/page');
    }   
    
    public function countryAction() {
        
        //if invalid region or country
        if ($this->dataModel->getDataByRegion($this->region) == FALSE || 
                !is_array($this->dataModel->getDataByRegion($this->region)[$this->country])) {
            
            $this->redirectToDefaultPage();
        }      
        
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getCountryDefaultHotels($this->region, $this->country)),
                    $this->buildTemplateVars()
        ));        
        $this->view->pick('index/page');
    }


    public function cityAction() {
        
        //if invalid region or country or city
        if ($this->dataModel->getDataByRegion($this->region) == FALSE || 
                !is_array($this->dataModel->getDataByRegion($this->region)[$this->country]) ||
                !is_array($this->dataModel->getDataByRegion($this->region)[$this->country][$this->city])                
                ) {
            
            $this->redirectToDefaultPage();
        }
        
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getHotelsByCity(
                    $this->region, $this->country, $this->city
                    )),
                    $this->buildTemplateVars()
        ));        
        
        $this->view->pick('index/page');
    }   
    
    public function setLanguageAction() {
        $this->response->redirect('merch/'. $this->languageCode. '/'. $this->campaignName);
    }
    
    /**
     * Set Input data to properties
     */    
    public function setInputvar() {
        
        $this->campaignName = (null == $this->dispatcher->getParam("campaignName")) ? 
                self::DEFAULT_PAGE_CAMPAIGN : $this->dispatcher->getParam("campaignName");
        
        $this->languageCode = (null == $this->dispatcher->getParam("languageCode")) ? 
                self::DEFAULT_PAGE_LANG : $this->dispatcher->getParam("languageCode");
        
        $this->region = (null == $this->dispatcher->getParam("regionName")) ? 
                self::DEFAULT_PAGE_REGION : $this->dispatcher->getParam("regionName");       
        
        $this->country = (null == $this->dispatcher->getParam("countryName")) ? null :
                $this->dispatcher->getParam("countryName");
        
        $this->city = (null == $this->dispatcher->getParam("cityName")) ? null : 
                $this->dispatcher->getParam("cityName");
    }
    
    /**
     * Setting page data
     */
    protected function setupPage()
    {
        //setting class variable
        $this->setInputvar();
        $this->user = new \HC\Merch\Models\Users();
        //get Top menu 
        //$this->menu     = $this->config->menuItems;        
        try {
            $this->menu = json_decode($this->Couch->get("menuItems"));
        } catch (CouchbaseException $ex) {
            echo $ex->getMessage();
        }
        
        
        // Setup data for the page
        $this->dataModel = new \HC\Merch\Models\Page();           
        $this->dataModel
                ->setCampaignName($this->campaignName)
                ->setRegion($this->region)
                ->setLanguageCode($this->languageCode);
        //Drop down menu
        $this->DDMenue  = $this->dataModel->loadCampaignData();       
        
        if ($this->dataModel->isLanguageFileExists() == FALSE)
            $this->languageCode = self::DEFAULT_PAGE_LANG;
        
        //get translation obj
        $this->translation  = new \HC\Library\Translation($this->languageCode, 
                $this->config->application->LanguageDir);
        //get site url
        $this->uriFull = $this->router->getRewriteUri();    
        $this->uriBase = $this->getBaseUrl();

        
       
    }
    
    private function buildTemplateVars() {       
       return array(
                'pageLayout'               => $this->getPageLayout(),
                'uriBase'                  => $this->uriBase,
                'uriFull'                  => $this->uriFull,
                'languageCode'             => $this->languageCode,               
                'menuItemsTop'             => $this->menu->top,
                'menuItemsSite'            => $this->menu->site,
                'menuItemsLanguageOptions' => $this->menu->languageOptions,
                'menuItemsRightSite'       => $this->menu->rightSite,
                'menuItemsAccount'         => $this->menu->account,
                'currentUser'              => $this->user->getCurrentUser() ,
                "t"                        => $this->translation->getTranslation(),
                'banners'                  => $this->dataModel->getBanner($this->region),
                'DDMenue'                  => $this->DDMenue,                
                "hotelDetails"             => $this->dataModel->loadHotelData()				
            );
        
    }
    
    private function campaignFileCheck() {
        
        if ($this->dataModel->loadCampaignData() == FALSE) {            
            return $this->response->redirect('merch/'. self::DEFAULT_PAGE_LANG. '/'. self::DEFAULT_PAGE_CAMPAIGN);
        }
    }

    protected function getPageLayout(){
        if(empty($this->data['meta']['pageLayout'])){
            // use session if avail
            return self::DEFAULT_PAGE_LAYOUT;
        }
    }    
    
    protected function getBaseUrl() {
        return '/merch/' . $this->languageCode . '/' . $this->campaignName;
    }
    
    private function redirectToDefaultPage() {
        return $this->response->redirect('merch/'. self::DEFAULT_PAGE_LANG. '/'. self::DEFAULT_PAGE_CAMPAIGN);
    }
    
    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @return mixed
     */
    public function getMenuTabMain()
    {
        return $this->menuTabMain;
    }

    /**
     * @return mixed
     */
    public function getMenuTabSub()
    {
        return $this->menuTabSub;
    }

    /**
     * @return mixed
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }
        
}
