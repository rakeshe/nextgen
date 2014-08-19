<?php
namespace HC\Merch\Controllers;
class IndexController extends ControllerBase
{

    const DEFAULT_PAGE_CAMPAIGN = 'test-campaign';    
    const DEFAULT_PAGE_LAYOUT = 'main';
    protected $uriBase;
    protected $uriFull;
    protected $pageLayout;
    protected $languageCode = 'en_AU';
    protected $campaignName = 'Summer-Escape';
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
    protected $region = 'Pacific';
    private $dataModel;
    

    public function initialize()
    {
        $this->view->setTemplateAfter($this->getPageLayout());
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
        
        $this->menu = $this->config->menuItems;        
        $this->translation  = new \HC\Library\Translation($this->languageCode, 
                $this->config->application->LanguageDir);  
        
        $this->dataModel = new \HC\Merch\Models\Page();   
        $this->dataModel->setLanguageCode($this->languageCode);
        $this->DDMenue = $this->dataModel->loadCampaignData();
       
        //var_dump($this->banner);
        // Setup data for the page
        $this->user = new \HC\Merch\Models\Users();
        
        //$this->setupPage();
        $this->getBaseUrl();
    }

    public function indexAction()
    {      
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getDefaultHoteles($this->region)),
                    $this->buildTemplateVars()
        ));        
        $this->view->pick('index/page');
    }

    public function pageAction()
    {          
        $this->view->setVars(
            array_merge(array ("hotels" => $this->dataModel->getCampaignDefaultHotels($this->region)),
                    $this->buildTemplateVars()
        ));
    }
    
    public function regionAction() {        
        
        $this->region = $this->dispatcher->getParam("regionName");
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
        
        $this->region  = $this->dispatcher->getParam("regionName");
        $this->country = $this->dispatcher->getParam("countryName");
        
        echo $this->region;
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
        
        $this->region   = $this->dispatcher->getParam("regionName");
        $this->country  = $this->dispatcher->getParam("countryName");
        $this->city     = $this->dispatcher->getParam("cityName");
        
        //if invalid region or country
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

    protected function setupPage()
    {
        $this->user = new \HC\Merch\Models\Users();
        $this->menu = $this->config->menuItems;
        $this->languageCode = $this->dispatcher->getParam("languageCode");
        $this->campaignName = null == $this->dispatcher->getParam(
            "campaignName"
        ) ? self::DEFAULT_PAGE_CAMPAIGN : $this->dispatcher->getParam("campaignName");
        $this->menuTabMain  = $this->dispatcher->getParam("menuTabMain");
        $this->menuTabSub   = $this->dispatcher->getParam("menuTabSub");
        $this->translation  = new \HC\Library\Translation($this->languageCode, 
                $this->config->application->LanguageDir);
        $this->uriFull = $this->router->getRewriteUri();
        //$this->uriBase = '/' . $this->languageCode . '/' . $this->campaignName;

        // Setup data for the page
        $dataModel = new \HC\Merch\Models\Page();
        if ($this->languageCode != null)
        	$dataModel->setLanguageCode($this->languageCode);
        
        $dataModel
            ->setCampaignName($this->campaignName)
            ->setMenuTabMain($this->menuTabMain)
            ->setMenuTabSub($this->menuTabSub);

        $this->data = $dataModel->getData();

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

    protected function getPageLayout(){
        if(empty($this->data['meta']['pageLayout'])){
            // use session if avail
            return self::DEFAULT_PAGE_LAYOUT;

        }
    }    
    
    protected function getBaseUrl() {
        $this->uriBase = '/merch/' . $this->languageCode . '/' . $this->campaignName;
    }
    
    private function redirectToDefaultPage() {
        return $this->response->redirect('merch/'. $this->languageCode. '/'. $this->campaignName);
    }
        
}
