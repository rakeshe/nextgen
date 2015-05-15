<?php

/**
 *
 * @package    DealsController.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class DealsController extends ControllerBase {


    private $cityData;

    public function initialize() {
        $this->init();
    }

    public function init() {

        $model = new \HC\Deals\Models\DealsModel();

        $this->cityData = $model->getCityDocument();
    }

    public function indexAction() {

        $this->view->setVars([
            'cityData' => $this->cityData
            ]);
        $this->view->pick('default/index/index');
    }

}