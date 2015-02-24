<?php
/**
 *
 * @package    WebtrendsHelper.php
 * @author     Rakesh Shrestha
 * @since      24/2/15 10:51 AM
 * @version    1.0
 */
namespace HC\Common\Helpers;

class WebtrendsHelper extends \Phalcon\Tag
{
    const DEFAULT_LOCALE = 'en_AU';
    const DEFATULT_POS = 'HCL';
    const DEFAULT_HOST_NAME = 'www.hotelclub.com';
    const DEFAULT_PROVIDER_DOMAIN = 'ctix8.cheaptickets.com';
    const DEFAUTL_DCSID = 'dcscfchfzvz5bdrpz13vsgjna_9r8u';

    var $dcsid;
    var $providerDomain;
    var $LNG;
    var $pos;
    var $hostname;
    var $owwPage;

    /**
     * @return mixed
     */
    public function getHostname()
    {
        if (null === $this->hostname) {
            $this->setHostname();
        }
        return $this->hostname;
    }

    /**
     * @param string $hostname
     * @return $this
     */
    public function setHostname($hostname = self::DEFAULT_HOST_NAME)
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOwwPage()
    {
        return $this->owwPage;

    }

    /**
     * @param $owwPage
     * @return $this
     */
    public function setOwwPage($owwPage)
    {
        $this->owwPage = $owwPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPos()
    {
        if (null === $this->pos) {
            $this->setPos();
        }
        return $this->pos;
    }

    /**
     * @param string $pos
     * @return $this
     */
    public function setPos($pos = self::DEFATULT_POS)
    {
        $this->pos = $pos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLNG()
    {
        if (null === $this->LNG) {
            $this->setLNG();
        }
        return $this->LNG;
    }

    /**
     * @param string $LNG
     * @return $this
     */
    public function setLNG($LNG = self::DEFAULT_LOCALE)
    {
        $this->LNG = $LNG;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDcsid()
    {
        if(null === $this->dcsid) $this->setDcsid();
        return $this->dcsid;
    }

    /**
     * @param string $dcsid
     * @return $this
     */
    public function setDcsid($dcsid = self::DEFAUTL_DCSID)
    {
        $this->dcsid = $dcsid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderDomain()
    {
        if(null === $this->providerDomain) $this->setProviderDomain();
        return $this->providerDomain;
    }

    /**
     * @param string $providerDomain
     * @return $this
     */
    public function setProviderDomain($providerDomain = self::DEFAULT_PROVIDER_DOMAIN)
    {
        $this->providerDomain = $providerDomain;
        return $this;
    }





    public function getWtMetaData(){
        return [
            'DCSext.LNG' => $this->getLNG(),
            'DCSext.pos' => $this->getPos(),
            'DCSext.hostname' => $this->getHostname(),
            'DCSext.owwPage' =>  $this->getOwwPage()
        ];
    }

    public function getWtDataCollectorData(){
        return [
            'dcsid' => $this->getDcsid(),
            'domain' => $this->getProviderDomain()
        ];
    }
    /*
     * return [
                'DCSext.LNG' => $this->languageCode,
                'DCSext.pos' => 'HCL',
                'DCSext.hostname' => 'www.hotelclub.com',
                'DCSext.owwPage' =>  $this->router->getRewriteUri()
            ];

     */
}