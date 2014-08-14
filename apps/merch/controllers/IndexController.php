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

    public function initialize()
    {
        $this->view->setTemplateAfter($this->getPageLayout());
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
        
        $this->menu = $this->config->menuItems;        
        $this->translation  = new \HC\Library\Translation($this->languageCode, 
                $this->config->application->LanguageDir);  
        
        // Setup data for the page
        $this->user = new \HC\Merch\Models\Users();
        
        //$this->setupPage();
        $this->getBaseUrl();
    }

    public function indexAction()
    {
        
    }

    public function pageAction()
    {       
        $dataModel = new \HC\Merch\Models\Page();        
        $dataModel ->setLanguageCode($this->languageCode);
        $this->data = $dataModel->getData();   	
        $this->view->setVars(
            array(
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
                "pageData"                 => $this->data,		
				
            )
        );
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

    protected function getPageLayout(){
        if(empty($this->data['meta']['pageLayout'])){
            // use session if avail
            return self::DEFAULT_PAGE_LAYOUT;

        }
    }    
    
    protected function getBaseUrl() {
        $this->uriBase = '/merch/' . $this->languageCode . '/' . $this->campaignName;
    }
        
}
