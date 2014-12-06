<?php

/**
 * @author     K.N. Santosh Hegde
 * @package    ErrorController
 * @since      23/10/14
 * @version    1.0
 */

namespace HC\Api\Controllers;

class IndexController extends ControllerBase {

    protected $responseType = 'json';
    protected $dataIdentifier;
    protected $value;

    public function initialize() {
        $this->init();
    }
    
    public function init() {
        if (!isset($this->dispatcher->getParams()[0]) || !isset($this->dispatcher->getParams()[1]) ||
                !isset($this->dispatcher->getParams()[2])) {
            
            $this->forward('Error/show404');         
        } else {
            //Set the identifire
            switch ($this->dispatcher->getParams()[0]) {
                case 'ip':
                    $this->dataIdentifier = $this->dispatcher->getParams()[0];
                    $this->setIP($this->dispatcher->getParams()[2]);
                    break;

                case 'member':
                    $this->dataIdentifier = $this->dispatcher->getParams()[0];
                    $this->setNumber($this->dispatcher->getParams()[2]);
                    break;

                default:
                    $this->forward('Error/show404');                    
                    break;
            }
            // Response data
            switch ($this->dispatcher->getParams()[1]) {
                case 'html':
                    $this->responseType = $this->dispatcher->getParams()[1];
                    break;
            }
        }
    }

    public function indexAction() {
        
    }

    public function recommendAction() {
        echo 'dataIdentifier:- '.$this->dataIdentifier . '<br />responseType:- ' . $this->responseType . '<br />value:- ' .$this->value;
    }    

    protected function setIP($value) {
        if (filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
            $this->value = $value;
        } else {
            $this->forward('Error/show404');
        }
    }

    protected function setNumber($value) {
        if (is_numeric($value)) {
            $this->value = $value;
        } else {
            $this->forward('Error/show404');
        }
    }

}
