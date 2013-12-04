<?php

class IndexController extends ControllerBase
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
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
        $this->setupPage();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice(
                'Welcome to nextgen php app'
            );
        }
    }

    public function pageAction()
    {
        $this->view->setVars(
            array(
                'pageLayout' => $this->getPageLayout(),
                'uriBase'                  => $this->uriBase,
                'uriFull'                  => $this->uriFull,
                'languageCode'             => $this->languageCode,
                'campaignName'             => $this->campaignName,
                'menuTabMain'              => $this->menuTabMain,
                'menuTabSub'               => $this->menuTabSub,
                'menuItemsTop'             => $this->menu->getMenuItem('top'),
                'menuItemsSite'            => $this->menu->getMenuItem('site'),
                'menuItemsLanguageOptions' => $this->menu->getMenuItem('languageOptions'),
                'menuItemsAccount'         => $this->menu->getMenuItem('account'),
                'currentUser'              => $this->user->getCurrentUser() ,
                "t"                        => $this->translation->getMessages(),
                "pageData"      => $this->data
            )
        );


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
        $this->user = new Users();
        $this->menu = new Menu();
        $this->languageCode = $this->dispatcher->getParam("languageCode");
        $this->campaignName = null == $this->dispatcher->getParam(
            "campaignName"
        ) ? self::DEFAULT_PAGE_CAMPAIGN : $this->dispatcher->getParam("campaignName");
        $this->menuTabMain  = $this->dispatcher->getParam("menuTabMain");
        $this->menuTabSub   = $this->dispatcher->getParam("menuTabSub");
        $this->translation  = new translation($this->languageCode);
        $this->uriFull = $this->router->getRewriteUri();
        $this->uriBase = '/' . $this->languageCode . '/' . $this->campaignName;

        // Setup data for the page
        $dataModel = new Page();
        $dataModel
            ->setLanguageCode($this->languageCode)
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
}
