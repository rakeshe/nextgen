<?php
/**
 *
 * @author     Rakesh Shrestha
 * @since      25/10/13 10:55 AM
 * @version    1.0
 */

class ControllerBase extends Phalcon\Mvc\Controller
{

    protected function initialize()
    {
        Phalcon\Tag::prependTitle('HotelClub | ');
    }

    protected function forward($uri){
    	$uriParts = explode('/', $uri);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
    	);
    }
}
