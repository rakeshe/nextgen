<?php
namespace HC\Api\Controllers;

use HC\Api\Models\ModelFactory;
use Phalcon\Http\Client\Exception,
    Phalcon\Http\Client\Request,
    Phalcon\Http\Response,
    Phalcon\Validation\Message,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\Regex as RegexValidator;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    const WHITE_LIST_URL_FILE = 'formWhiteListUrls.json';

    // the doc generate format:-> [env]:deals:[md5('white_list')];
    const WHITE_LIST_DOCUMENT_FILE = 'deals:0254505138836ad899ee5b0fa8d79ef9';

    const DEFAULT_WHITE_LIST_HOSTS = 'www.hotelclub.com, www.hotelclub.cn, cmsref.hotelclub.com, hotelclub.com';

    const DEFAULT_VIEW_PARTIAL = 'body';
    const DEFAULT_VIEW_DEVICE = 'desktop';

    protected $whiteListUrls;

    protected $whiteListType;

    protected $isWhiteListed = false;

    protected $responseContentType = 'application/json';

    protected $availableHosts = [];

    protected $hostName;

    protected $params;

    /** @var  \HC\Api\Models\ApiModel */
    protected $apiModel;

    protected $viewDevice;


    protected function initialize()
    {

        $this->view->disable();
        $this->apiModel = ModelFactory::build($this->router->getControllerName());
        $this->apiModel->setActionName($this->router->getActionName());
        $this->apiModel->init($this->request);
        $this->apiModel->setParams($this->getParams());
    }

    /**
     * Verify hash code
     */
    protected function verifyHash()
    {

        if (isset(getallheaders()['Authorization']) && null != getallheaders()['Authorization']) {

            if (isset($this->availableHosts[$this->hostName])
                && getallheaders()['Authorization'] === $this->availableHosts[$this->hostName]
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verify request type
     *
     * @return bool
     */
    protected function verifyRequestType()
    {

        return $this->request->isGet() && true == $this->request->isAjax();
    }

    /**
     * load whitelist url file
     */

    protected function loadWhiteListUrls()
    {

        try {

            if (file_exists(__DIR__ . '/../../../data/' . self::WHITE_LIST_URL_FILE)) {
                //require_once __DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE;
                $this->whiteListUrls = json_decode(
                    file_get_contents(__DIR__ . '/../../../data/' . self::WHITE_LIST_URL_FILE),
                    true
                );
            } else {
                throw new Exception('required file does not exists');
            }

        } catch (\Exception $e) {
            $this->getExceptionMessage($e);
        }
    }

    /**
     * To verify app key
     *
     * @return bool
     */
    protected function verifyAppKey()
    {

        if (null != $this->request->getQuery('api_key') &&
            array_key_exists($this->request->getQuery('api_key'), $this->whiteListUrls)
        ) {

            $this->availableHosts = $this->whiteListUrls[$this->request->getQuery('api_key')];
            return true;
        }
        return false;
    }

    /**
     * Verify host name or IP is whitelisted or not
     *
     * @return bool
     * @todo, verify host logic, check md5(getHttpHost().':'.secret_salt) againsts api_key
     */
    protected function verifyHost()
    {

        $model = $this->apiModel;
        if ($model->getApiId() && $model->getApiKey()) {

            // Allow all from white listed
            if (in_array($model->getRequestHost(), $this->config->whiteListDomains)) {
                return true;
            }

            $hostKey = md5($model->getRequestHost() . ':' . $this->config->secretKey->salt);
            return $hostKey === $model->getApiKey();

        }

// @todo refactor this
//        if (null !== $this->request->getHttpHost() && null !== $this->availableHosts &&
//            array_key_exists($this->request->getHttpHost(), $this->availableHosts)) {
//            $this->whiteListType = 'HOST';
//            $this->isWhiteListed = true;
//            $this->hostName = $this->request->getHttpHost();
//            return true;
//        } else if (null !== $this->request->getClientAddress() && null !== $this->availableHosts &&
//            array_key_exists($this->request->getClientAddress(), $this->availableHosts)) {
//            $this->whiteListType = 'IP';
//            $this->isWhiteListed = true;
//            $this->hostName = $this->request->getClientAddress();
//            return true;
//        }
        return false;
    }


    /**
     * Get exception info
     *
     * @param object $e
     */
    protected function getExceptionMessage($e)
    {
        $exceptionMessage = "API Exception Message: " . $e->getMessage(
            ) . PHP_EOL . "Stack:" . PHP_EOL . $e->getTraceAsString();
        if ('dev' === ORBITZ_ENV) {
            echo $exceptionMessage;
        } else {
            $this->getDI()->getShared('logger')->log($exceptionMessage);
        }

    }

    protected function sendOutput($httpCode, $content = false)
    {

        $res = new Response;
        $res
            ->setHeader("Content-Type", "{$this->responseContentType}; charset=UTF-8")
            ->setRawHeader("HTTP/1.1 {$httpCode}")
            ->setStatusCode($httpCode, '')
            ->setContent($content)
            ->send();
        die();
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        if ($uriParts[1] == 'show404') {
            $this->show404();
        } else {
            return $this->dispatcher->forward(
                array(
                    'controller' => $uriParts[0],
                    'action'     => $uriParts[1]
                )
            );
        }
    }

    protected function updateWhiteListFile()
    {

        $filePath = __DIR__ . '/../../../data/' . self::WHITE_LIST_URL_FILE;

        $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];

        $cacheData = $Couch->get(ORBITZ_ENV . ':' . self::WHITE_LIST_DOCUMENT_FILE);

        if (null != $cacheData) {

            $storeFile = true;

            if (file_exists($filePath)) {
                $interval = strtotime('-24 hours');
                if (filemtime($filePath) <= $interval) {
                    $storeFile = true;
                } else {
                    $storeFile = false;
                }
            }
            $request = new \Phalcon\Http\Request();
            $forceWrite = $request->getQuery('reload-whitelist-cache');
            if ($forceWrite == 'yes') {
                $storeFile = true;
            }
            if ($storeFile) {
                $file = fopen($filePath, 'w');
                fputs($file, $cacheData);
                fclose($file);
            }
        }
    }

    protected function show404()
    {
        header("HTTP/1.0 404 Not Found");
        die();
    }

    /**
     * Enable view
     */
    protected function enableView()
    {
        $di = $this->getDI();
        $di['view']->enable();
    }

    protected function renderView($partial = self::DEFAULT_VIEW_PARTIAL, $path=null)
    {
        $path = null === $path ? $this->router->getControllerName() : $path;
        $this->view->render( $path .'/' . $this->getViewDevice(), $partial);
    }

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
    public function getViewDevice()
    {
       if(null === $this->viewDevice) $this->setViewDevice();
        return $this->viewDevice;
    }

    /**
     * @param mixed $viewDevice
     */
    public function setViewDevice($viewDevice = self::DEFAULT_VIEW_DEVICE)
    {
        $this->viewDevice = $viewDevice;
    }



}
