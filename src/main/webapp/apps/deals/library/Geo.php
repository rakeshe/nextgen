<?php

namespace HC\Deals\Library;

use Phalcon\Http\Client\Request;

class Geo
{

    //const DEV_URL = 'http://teakettle.dev.o.com/location/';

    const QA_URL = 'http://teakettle.qa1.o.com/location/';

    const PROD_URL = 'http://teakettle.prod.o.com/location/';

    const PAYLOAD_CITY_BY_IP = 'geoip/city?ip=[IP_ADDRESS]';

    const PAYLOAD_LOCALE_BY_IP = 'locale/currency/ip/[IP_ADDRESS]/HCL';

    const PROXY_URL = 'http://www.hotelclub.com/n/api/proxy/request/';

    protected $url;

    protected $ip;

    protected $diagnosis = false;


    protected $headers = ['Accept' => 'application/json'];


    public function __construct($ip, $env = ORBITZ_ENV, $diagnosis = true) {

        $this->ip = $ip;
        $this->url = $env == 'production' ? self::PROD_URL : self::QA_URL;
        $this->diagnosis = $diagnosis;
    }


    private function buildLocaleUrl() {

        $payloadLocaleURL = str_replace('[IP_ADDRESS]', $this->ip, self::PAYLOAD_LOCALE_BY_IP);
        return $payloadLocaleURL;
    }

    private function buildCityUrl() {

        $payloadLocaleURL = str_replace('[IP_ADDRESS]', $this->ip, self::PAYLOAD_LOCALE_BY_IP);
        return $payloadLocaleURL;
    }

    public function getLocale() {

        $url = $this->buildLocaleUrl();
        $result = $this->makeRequest($this->url, $url);

        return $result;
    }

    public function getCity() {

        $url = $this->buildCityUrl();
        $result = $this->makeRequest($this->url, $url);

        return $result;

    }

    private function makeRequest($baseUrl, $url) {

        try {
            $req = Request::getProvider();
            $req->setBaseUri($baseUrl);
            $req->header->setMultiple($this->headers);
            $response = $req->get($url);

            return $response;

        } catch (\Exception $e) {

            if (true == $this->diagnosis && $e->getCode() == 6) {

                $this->diagnosis = false;
                return $this->makeRequest(self::PROXY_URL, $url);
            } else {
                echo $e->getMessage();
            }
        }
    }

}