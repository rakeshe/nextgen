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


    const DEFAULT_CITY = 'Sydney';

    const DEFAULT_WHEN = '7-days';

    const DEFAULT_URL = 'n/sale/deals';

    private $cityData;

    private $model;

    private $city;

    private $when;

    private $sort;

    private $appendURL;

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

        $this->setParams();
    }

    private function setParams() {

       // var_dump($this->dispatcher->getParams());
        //var_dump($this->request->get()); exit;

        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[0]))
            $this->city = $this->dispatcher->getParams()[0];
        else {
            $this->city = self::DEFAULT_CITY;
            $this->appendURL .= self::DEFAULT_CITY;
        }


        //if exists and should be validated

        if (isset($this->dispatcher->getParams()[1]))
            $this->when = $this->dispatcher->getParams()[1];
        else {
            $this->when = self::DEFAULT_WHEN;
            $this->appendURL .= (NULL !== $this->appendURL) ? '/' . self::DEFAULT_WHEN
                                    : self::DEFAULT_WHEN;
        }

        if (isset($this->request->get()['sort']))
            $this->sort = $this->request->get()['sort'];

    }

    public function indexAction() {

        $this->cityData = $this->model->getCityDocument();

        $this->view->setVars([
            'cityData'  => $this->cityData,
            'city'      => $this->city,
            'when'      => $this->when,
            'sort'      => $this->sort,
            'appendURL' => $this->appendURL,
            'url'       => self::DEFAULT_URL,
            'hData'     => $this->model->getHotels('', $this->city),
            ]);

        $this->view->pick('default/index/index');
    }

}