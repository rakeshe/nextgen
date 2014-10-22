<?php
/**
 * @author     Rakesh Shrestha
 * @package    ErrorController
 * @since      25/11/13 11:44 AM
 * @version    1.0
 */
namespace HC\Merch\Controllers;
class ErrorController extends ControllerBase
{
    protected $uriBase;
    protected $uriFull;   
    protected $languageCode;   
    protected $menuTabMain;    
    protected $user;  
    protected $menu; 
    protected $campaignName;
    protected $translation;
   
    public function initialize()
    {
       $this->response->setHeader(404, 'Not Found');
        \Phalcon\Tag::setTitle('Page Not Found');
        parent::initialize();
        $this->setupPage();
    }
    
    public function show404Action()
    {
        $this->view->setVars(
            array(               
                'uriBase'                  => $this->uriBase,
                'uriFull'                  => $this->uriFull,
                'languageCode'             => $this->languageCode,               
                'menuTabMain'              => $this->menuTabMain,
                'menuTabSub'               => $this->menuTabSub,
                'menuItemsTop'             => $this->menu->top,
                'menuItemsSite'            => $this->menu->site,
                'menuItemsLanguageOptions' => $this->menu->languageOptions,
                'menuItemsRightSite'       => $this->menu->rightSite,
                'menuItemsAccount'         => $this->menu->account,                
                "t"                        => $this->translation->getTranslation(),                
            )
        );
        
        $this->view->pick('404/404');
    }
    
    protected function setupPage()
    {
        $this->user = new \HC\Merch\Models\Users();
        $this->menu = $this->config->menuItems;
        $this->languageCode = 'en_AU';       
        $this->menuTabMain  = $this->dispatcher->getParam("menuTabMain");
        $this->menuTabSub   = $this->dispatcher->getParam("menuTabSub");
        $this->translation  = new \HC\Library\Translation($this->languageCode, 
                []);
        $this->uriFull = $this->router->getRewriteUri();
        $this->uriBase = '/' . $this->languageCode . '/' . $this->campaignName;
    }
}
