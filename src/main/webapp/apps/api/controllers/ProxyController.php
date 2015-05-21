<?php
/**
 *
 * @package    ProxyController.php
 * @author     Rakesh Shrestha
 * @since      6/2/15 11:59 AM
 * @version    1.0
 */


namespace HC\Api\Controllers;

use HC\Api\Models\ProxyModel;
use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class ProxyController extends ControllerBase
{
    protected $provider;
    protected $providerResponse;


    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->setProvider();
        /** @var ProxyModel $apiModel */
        $apiModel = $this->apiModel;
        //set pricing gateway url path
        $this->provider->setBaseUri($apiModel->getProxyBaseUri());

        //set header
        $this->provider->header->setMultiple($apiModel->getProxyHeaders());
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public function setProvider()
    {
        $this->provider = Request::getProvider();
    }

    /**
     * make request using phalcon incubator
     *
     */
    public function makeRequest()
    {
        $payload = $this->apiModel->getProxyPayload();
        if ($payload) {
            try {
                $response = $this->apiModel->getProxyMethod() === \HC\Api\Models\ApiModel::REQUEST_METHOD_POST ?
                    $this->provider->post('', $payload) :
                    $this->provider->get($payload);

                return $response->body;
            } catch (\Exception $e) {
                $this->getExceptionMessage($e);
            }

        }
    }

    /**
     * @param $body
     */
    protected function sendResponse($body)
    {

        $httpResponse = new Response();
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
        $this->providerResponse = $this->makeRequest();
        $this->sendResponse($this->providerResponse);
    }

}
