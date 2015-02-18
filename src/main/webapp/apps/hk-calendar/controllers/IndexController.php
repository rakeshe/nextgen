<?php

/**
 *
 * @package    Index controller
 */

namespace HC\HkCalendar\Controllers;
use \Phalcon\Mvc\Controller;

class IndexController extends Controller {

    const PAGE_TITLE = "Experience Hong Kong | The Unmissable Events | HotelClub";

    public function initialize() {

    }
    
    /**
     * Loading first time
     */
    public function init() {
        \Phalcon\Tag::setTitle('Hong Kong Interactive Calendar');
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
            'title'      => self::PAGE_TITLE
        ));
    }

}
