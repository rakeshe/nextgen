<?php
/**
 * @author     K.N. Santosh Hegde
 * @package    ErrorController
 * @since      23/10/14
 * @version    1.0
 */
namespace HC\Api\Controllers;
class ErrorController extends ControllerBase
{
    public function initialize() {
        parent::initialize();        
    }   
    
    public function show404Action() {
        // @todo quick fix remove this later
//        $this->response->redirect ( 'merch/en_AU/worldonsale');
        $this->response->setHeader(404, 'Not Found');
        die();
    }
        
    
}
