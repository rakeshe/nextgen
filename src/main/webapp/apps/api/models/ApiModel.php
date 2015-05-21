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

    protected $apiId;

    protected $apiKey;

    /** @var \Phalcon\Http\Request */
    protected $request;

    protected $requestHost;

    protected $requestHttpRefererHost;

    protected $requestMethod;

    protected $requestHeaders;

    protected $requestPayload;

    public function init(\Phalcon\Http\Request $request)
    {
        $this->setRequest($request)
            ->setRequestHeaders()
            ->setRequestHost()
            ->setRequestHttpRefererHost()
            ->setRequestMethod()
            ->setRequestPayload()
            ->setApiId()
            ->setApiKey();
    }

    /**
     * @return mixed
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
            $referer = parse_url($this->request->getHTTPReferer());
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

}
