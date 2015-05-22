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

    private $model;

    public function initialize() {

        $this->init();

        if ($this->request->isPost() && $this->request->isAjax()) {

            $hotelData = $this->model->getHotels($this->request->getPost('region', 'string'),
                $this->request->getPost('city', 'string'));

            die($hotelData);
        }


    }

    public function init() {

        $this->model = new \HC\Deals\Models\DealsModel();
    }

    public function indexAction() {

        $this->cityData = $this->model->getCityDocument();

        $this->view->setVars([
            'cityData' => $this->cityData
            ]);
        $this->view->pick('default/index/index');
    }

}