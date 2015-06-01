<?php
/**
 *
 * @package    ProxyModel.php
 * @author     Rakesh Shrestha
 * @since      19/5/15 12:09 PM
 * @version    1.0
 */
namespace HC\Api\Models;

class ProxyModel extends ApiModel
{

    protected $proxyBaseUri;
    protected $proxyPort;
    protected $proxyMethod;
    protected $proxyHeaders;
    protected $proxyPayload;


    public function  init(\Phalcon\Http\Request $request)
    {

        parent::init($request);
        $this->setProxyBaseUri()
            ->setProxyHeaders()
            ->setProxyMethod()
            ->setProxyPayload()
            ->setProxyPort()
            ;
    }

    /**
     * @return mixed
     */
    public function getProxyBaseUri()
    {
        return $this->proxyBaseUri;
    }

    /**
     * @return $this
     */
    public function setProxyBaseUri()
    {
        if ($this->request) {
            $this->proxyBaseUri = $this->request->hasPost('host') ?
                $this->request->getPost('host') : $this->request->getQuery('host');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProxyHeaders()
    {
        return $this->proxyHeaders;
    }

    /**
     * @return $this
     */
    public function setProxyHeaders()
    {
        if ($this->request) {
            $this->proxyHeaders = $this->request->hasPost('headers') ?
                $this->request->getPost('headers') : $this->request->getQuery('headers');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProxyMethod()
    {
        return $this->proxyMethod;
    }

    /**
     * @return $this
     */
    public function setProxyMethod()
    {
        if ($this->request) {
            $this->proxyMethod = $this->request->hasPost('method') ?
                $this->request->getPost('method') : $this->request->getQuery('method');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProxyPayload()
    {
        return $this->proxyPayload;
    }

    /**
     * @return $this
     */
    public function setProxyPayload()
    {
        if ($this->request) {
            $this->proxyPayload = $this->request->hasPost('payload') ?
                $this->request->getPost('payload') : $this->request->getQuery('payload');
        }
        return $this;

    }

    /**
     * @return mixed
     */
    public function getProxyPort()
    {
        return $this->proxyPort;
    }

    /**
     * @return $this
     */
    public function setProxyPort()
    {
        if ($this->request) {
            $this->proxyPort = $this->request->hasPost('port') ?
                $this->request->getPost('port') : $this->request->getQuery('port');
        }
        return $this;
    }



}