<?php

/**
 *
 * @package    ApiModel
 * @author     K.N. Santosh Hegde
 * @since      24/10/14
 * @version    1.0
 */

namespace HC\Api\Models;

class ApiModel
{

    const   REQUEST_METHOD_GET = 'GET';
    const   REQUEST_METHOD_POST = 'POST';
    const   REQUEST_METHOD_AJAX = 'AJAX';
    const DEFAULT_LOCALE = 'en_AU';
    const FILE_CACHE_PATH = '/../../../data/';
    protected $controllerName;
    protected $actionName;
    protected $apiId;

    protected $apiKey;

    /** @var \Phalcon\Http\Request */
    protected $request;

    protected $requestHost;

    protected $requestHttpRefererHost;

    protected $requestMethod;

    protected $requestHeaders;

    protected $requestPayload;

    protected $paramKeys;
    protected $params;
    protected $locale;
    protected $cacheData;
    protected $cacheDocumentName;
    protected $cacheFileName;

    public function init(\Phalcon\Http\Request $request)
    {
        $this->setRequest($request)
            ->setRequestHeaders()
            ->setRequestHost()
            ->setRequestHttpRefererHost()
            ->setRequestMethod()
            ->setRequestPayload()
            ->setApiId()
            ->setApiKey()
            ->setCacheDocumentName()
            ->setCacheFileName();
    }

    /**
     * @return \Phalcon\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Phalcon\Http\Request $request
     * @return $this
     */
    public function setRequest(\Phalcon\Http\Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestHeaders()
    {
        if (null === $this->requestHeaders) {
            $this->setRequestHeaders();
        }

        return $this->requestHeaders;
    }

    /**
     * @return $this
     */
    public function setRequestHeaders()
    {
        if ($this->request) {
            $this->requestHeaders = $this->request->getHeaders();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestHost()
    {
        return $this->requestHost;
    }

    /**
     * @return $this
     */
    public function setRequestHost()
    {
        if ($this->request) {
            $this->requestHost = $this->request->getHttpHost();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestHttpRefererHost()
    {
        return $this->requestHttpRefererHost;
    }

    /**
     * @return $this
     */
    public function setRequestHttpRefererHost()
    {
        if ($this->request) {
            $referer                      = parse_url($this->request->getHTTPReferer());
            $this->requestHttpRefererHost = !empty($referer['host']) ? $referer['host'] : null;
        }
        return $this;
    }


    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return $this
     */
    public function setRequestMethod()
    {
        if ($this->request) {
            $this->requestMethod = $this->request->getMethod();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestPayload()
    {
        return $this->requestPayload;
    }

    /**
     * @return $this
     */
    public function setRequestPayload()
    {
        if ($this->request) {
            $this->requestPayload = $this->request->getRawBody();
        }
        return $this;
    }


    /**
     * @return mixed
     */
    public function getApiId()
    {
        if (null === $this->apiId) {
            $this->setApiId();
        }
        return $this->apiId;
    }


    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return $this
     */
    public function setApiId()
    {
        if ($this->request) {
            $this->apiId = $this->request->hasPost('api_id') ? $this->request->getPost(
                'api_id'
            ) : $this->request->getQuery('api_id');
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function setApiKey()
    {
        if ($this->request) {
            $this->apiKey = $this->request->hasPost('api_key') ? $this->request->getPost(
                'api_key'
            ) : $this->request->getQuery('api_key');
        }
        return $this;
    }


    public function verifyRequestMethod()
    {
        if ($this->request) {
            return in_array(
                $this->request->getMethod(),
                [self::REQUEST_METHOD_GET, self::REQUEST_METHOD_POST, self::REQUEST_METHOD_AJAX]
            );
        }
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
        if (!empty($params)) {
            foreach ($params as $index => $paramValue) {
                if (!empty($this->paramKeys[$index])) {
                    $paramKey        = $this->paramKeys[$index];
                    $this->$paramKey = $paramValue;
                }
            }

        }

    }

    /**
     * @return mixed
     */
    public function getCacheDocumentName()
    {
        if(null === $this->cacheDocumentName) $this->setCacheDocumentName();
        return $this->cacheDocumentName;
    }

    /**
     *
     */
    public function setCacheDocumentName()
    {
        $this->cacheDocumentName = $this->getControllerName() . ':' . $this->getActionName();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCacheFileName()
    {
        if(null === $this->cacheFileName) $this->setCacheFileName();
        return $this->cacheFileName;
    }

    /**
     * @return $this
     */
    public function setCacheFileName()
    {
        $cacheFilePath       = __DIR__ . self::FILE_CACHE_PATH;
        $this->cacheFileName = $cacheFilePath . 'api-'
            . str_replace(':','_',$this->getCacheDocumentName())
            . '_' . $this->getLocale() . '.json';
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCacheData()
    {
        if (null === $this->cacheData) {
            $this->setCacheData();
        }
        return $this->cacheData;
    }

    /**
     */
    public function setCacheData()
    {
        $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
        $couchDocumentName = ORBITZ_ENV . ':api:' . md5($this->getCacheDocumentName()) . ':' . strtolower($this->getLocale());

        $cacheData = $Couch->get($couchDocumentName);

        if (null != $cacheData) {
            $this->setFileData($cacheData);
        } else {
            $cacheData = $this->getFileData();
        }
        $this->cacheData =  $cacheData;
        return $this;
    }


    protected function setFileData($fileData)
    {
        $filePath = $this->getCacheFileName();
        $setFile  = true;

        if (file_exists($filePath)) {
            $interval = strtotime('-24 hours');
            if (filemtime($filePath) <= $interval) {
                $setFile = true;
            } else {
                $setFile = false;
            }
        }
        $request    = new \Phalcon\Http\Request();
        $forceWrite = $request->getQuery('cacherefresh');
        if ($forceWrite == 'yes') {
            $setFile = true;
        }
        if ($setFile) {
            $file = fopen($filePath, 'w');
            fputs($file, json_encode($fileData));
            fclose($file);
        }

    }

    protected function getFileData()
    {

        $filePath = $this->getCacheFileName();

        if (file_exists($filePath)) {
            $stream = fopen($filePath, "r");
            $return = stream_get_contents($stream);
            fclose($stream);
            return $return;
        }
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        if(null== $this->locale) $this->setLocale();
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale = self::DEFAULT_LOCALE)
    {
        $this->locale = $locale;
    }


    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param mixed $controllerName
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }


}
