<?php

/**
 * @author     K.N. Santosh Hegde
 * @package    Mix and Match
 * @since      09/02/2015
 * @version    1.0
 */
namespace HC\MixAndMatch\Controllers;
use \Phalcon\Mvc\Controller;

class IndexController extends Controller {

    const THEME_PATH = "themes/mixandmatch/";
    const TEMPLATE_SERVER_PATH = "http://exauric.com.au/hc_menulog/";
    const EMAIL_TEMPLATE_DIR = "email-templates";

    public function initialize() {

        if ($this->request->isAjax() && $this->request->getPost('isMail') == 'true') {
            $this->sendMessage();
        }

    }
    
    /**
     * Loading first time
     */
    public function init() {
        \Phalcon\Tag::setTitle('Foodcation');
    }

    /**
     * Get user language
     * @return string
     */
    public function getLang() {
        return 'en';
    }

    /**
     * 
     * Default action
     */
    public function indexAction() {

        // load classes
        $this->init(); 
        //set variable for view
        $this->view->setVars(array(
            'appVersion' => APPLICATION_VERSION,
            'theme'      => self::THEME_PATH
        ));
    }

    public function getTemplate($name, $params) {

        $this->view->setVars($params);
        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render(self::EMAIL_TEMPLATE_DIR, $name);
        $view->finish();
        return $view->getContent();
    }

    public function sendMessage() {

       $html = $this->getTemplate('offer', [
            'serverPath' => self::TEMPLATE_SERVER_PATH,
            'firstName'  => 'Santosh Hegde'
        ]);
    }

}
