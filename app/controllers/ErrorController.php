<?php
/**
 * @author     Rakesh Shrestha
 * @package    ErrorController
 * @since      25/11/13 11:44 AM
 * @version    1.0
 */

class ErrorController extends \Phalcon\Mvc\Controller
{
    public function show404Action()
    {
        $this->response->setHeader(404, 'Not Found');
        $this->view->pick('404/404');
    }
}
