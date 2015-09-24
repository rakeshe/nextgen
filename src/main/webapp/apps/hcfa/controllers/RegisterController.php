<?php

namespace HC\HCFA\Controllers;

/**
 *
 * @package    RegisterController.php
 * @author     K.N. Santosh Hegde
 * @since      24/09/2015
 * @version    1.0
 */

class RegisterController extends ControllerBase {


    public function initialize() {

    }

    public function indexAction() {
        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
        ]);
    }

}