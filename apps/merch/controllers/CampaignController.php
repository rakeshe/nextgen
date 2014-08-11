<?php
/**
 *
 * @package    Campaign Controller
 * @author     K.N. Santosh Hegde
 * @since      11/8/2014
 * @version    1.0
 */

namespace HC\Merch\Controllers;
class CampaignController extends ControllerBase
{
    const DEFAULT_PAGE_CAMPAIGN = 'test-campaign';
    const DEFAULT_PAGE_LAYOUT = 'main';
    protected $uriBase;
    protected $uriFull;
    protected $pageLayout;
    protected $languageCode;
    protected $campaignName;
    protected $menuTabMain;
    protected $menuTabSub;
    
     public function initialize()
    {        
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();    
        $this->setupPage();
    }
    
    public function indexAction() {
        echo '<h1>from index</h1>';
        $this->setViewVariables();
        $this->view->pick("index/page");
    }
    
    public function cityAction() {
        echo '<h1>from city</h1>';
        $this->view->pick("index/page");
        $this->setViewVariables();
        $this->view->pick("index/page");
    }
    
    public function countryAction() {
        echo '<h1>from country</h1>';
        $this->view->pick("index/page");
        $this->setViewVariables();
        $this->view->pick("index/page");
    }
    
    public function regionAction() {
        echo '<h1>from region</h1>';
        $this->view->pick("index/page");
        $this->setViewVariables();
        $this->view->pick("index/page");
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
        $this->uriBase = '/' . $this->languageCode . '/' . $this->campaignName;

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
    
    private function setViewVariables () {
        $this->view->setVars(
            array(
                'pageLayout' => $this->getPageLayout(),
                'uriBase'                  => $this->uriBase,
                'uriFull'                  => $this->uriFull,
                'languageCode'             => $this->languageCode,
                'campaignName'             => $this->campaignName,
                'menuTabMain'              => $this->menuTabMain,
                'menuTabSub'               => $this->menuTabSub,
                'menuItemsTop'             => $this->menu->top,
                'menuItemsSite'            => $this->menu->site,
                'menuItemsLanguageOptions' => $this->menu->languageOptions,
                'menuItemsRightSite'       => $this->menu->rightSite,
                'menuItemsAccount'         => $this->menu->account,
                'currentUser'              => $this->user->getCurrentUser() ,
                "t"                        => $this->translation->getTranslation(),
                "pageData"                 => $this->data
            )
        );
    }
    protected function getPageLayout(){
        if(empty($this->data['meta']['pageLayout'])){
            // use session if avail
            return self::DEFAULT_PAGE_LAYOUT;

        }
    }  
    
}

