<?php
namespace HC\Api\Controllers;
class ControllerBase extends \Phalcon\Mvc\Controller
{

    protected function initialize()
    {
      
    }

    protected function forward($uri){
    	$uriParts = explode('/', $uri);
        if ($uriParts[1] == 'show404')
            $this->show404();
        else
            return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
            );
    }
    
    protected function show404() {
      header("HTTP/1.0 404 Not Found");
      die();
    }
}
