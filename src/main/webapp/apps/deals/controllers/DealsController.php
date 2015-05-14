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


    public function initialize() {


    }

    public function indexAction() {

      $this->view->pick('default/index/index');
    }

}