<?php
/**
 *
 * @package    ProxyController.php
 * @author     Rakesh Shrestha
 * @since      6/2/15 11:59 AM
 * @version    1.0
 */


namespace HC\Api\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class ProxyController extends ControllerBase
{

    const   REQUEST_METHOD_GET = 'GET';
    const   REQUEST_METHOD_POST = 'POST';
    const   REQUEST_METHOD_AJAX = 'AJAX';

    protected $requestHost;
    protected $requestPort;
    protected $requestHeader;
    protected $requestPayload;
    protected $requestMethod;

    protected $params;
    protected $provider;
    protected $response;

    /**
     *
     */
    public function init()
    {
    }


    /**
     *
     */
    public function initialize()
    {
        $this->view->disable();
        if ($this->request->isPost() == true) {
            $this->provider  = Request::getProvider();

            $this->requestHost =  $this->request->getPost("host");
            $this->requestPort =  $this->request->getPost("port");
            $this->requestHeader =  $this->request->getPost("header");
            $this->requestPayload =  $this->request->getPost("payload");
            $this->requestMethod =  $this->request->getPost("method");

        } else {
            $this->forward('Error/show404');
        }
    }

    /**
     * make request using phalcon incubator
     *
     */
    public function makeRequest() {

        $provider  = Request::getProvider();
        //set pricing gateway url path
        $provider->setBaseUri($this->requestHost);
        //set header
        $provider->header->setMultiple($this->requestHeader);
        //Set proxy
//        $provider->setProxy($this->proxyHost, $this->proxyPort );
        //send xml post data
        $response = $this->requestMethod === self::REQUEST_METHOD_POST ?
            $provider->post('', $this->requestPayload) :
            $provider->get($this->requestPayload);

        //get response
        return $response->body;
    }

    /**
     * Encapusulation: Getters and Setters
     */


    /**
     * @return null
     */
    public function getParams()
    {
        if ($this->params === null) {
            $this->setParams();
        }
        return $this->params;
    }

    /**
     * @return $this
     */
    public function setParams()
    {
        $this->params = $this->dispatcher->getParams();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }


    /**
     * @return null
     */
    protected function getHttpRefererHost()
    {
        $request = new \Phalcon\Http\Request();
        $referer = parse_url($request->getHTTPReferer());
        return !empty($referer['host']) ? $referer['host'] : null;

    }


    /**
     * @param $body
     */
    protected function sendResponse($body)
    {

        $httpResponse =  new Response();
        $httpResponse->setHeader("Content-Type", "application/xml");
        $httpResponse->setRawHeader("HTTP/1.1 200 OK");
        $httpResponse->setStatusCode(200, "OK");
        $httpResponse->setContent($body);
        $httpResponse->send();
    }

    /**
     * @param string $context
     */
    protected function send404Response($context = 'location')
    {
        $this->getResponse()
            ->setStatusCode(404, "Not Found")
            ->setContent("Sorry, {$context} could not be found")
            ->send();

    }


    /**
     * @param $response
     */
    protected function dumpResponse($response)
    {
        echo $response->header->get('Content-Type') . PHP_EOL;
        echo $response->header->statusCode . PHP_EOL;
        echo $response->body;

    }


    public function  requestAction()
    {
        $this->response = $this->makeRequest();
        $this->sendResponse($this->response);
    }



}
