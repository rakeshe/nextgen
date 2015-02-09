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

    public function initialize() {

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

}
