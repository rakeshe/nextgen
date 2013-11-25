<?php

class IndexController extends ControllerBase
{

    const DEFAULT_PAGE_CAMPAIGN = 'test-campaign';
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
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
        $language = $this->dispatcher->getParam("language");
        $campaignName = null == $this->dispatcher->getParam("campaignName") ? self::DEFAULT_PAGE_CAMPAIGN : $this->dispatcher->getParam("campaignName");
        $menuTabMain  = $this->dispatcher->getParam("menuTabMain");
        $menuTabSub   = $this->dispatcher->getParam("menuTabSub");
        $translation = new translation($language);

        $this->view->setVars(
            array(
                'language'     => $language,
                'campaignName' => $campaignName,
                'menuTabMain'  => $menuTabMain,
                'menuTabSub'   => $menuTabSub,
                "t" => $translation->getMessages(),
            )
        );


    }
}
