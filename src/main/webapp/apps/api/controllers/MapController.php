<?php
/**
 *
 * @package    MapController.php
 * @reference  https://developers.google.com/maps/documentation/javascript/reference
 * @author     Rakesh Shrestha
 * @since      6/2/15 11:59 AM
 * @version    1.0
 */


namespace HC\Api\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class MapController extends ControllerBase
{

    const DEFAULT_MAP_WIDTH = 800;
    const DEFAULT_MAP_HEIGHT = 800;
    const DEFAULT_MAP_LANGUAGE = 'en-AU';

    const DEFAULT_API_MODEL = 'google';
    const DEFAULT_LOCALE = 'en_AU';

    const BASE_URL = 'http://www.hotelclub.com';
    const GOOGLE_MAP_URI = "//maps.googleapis.com/maps/api/js?key=AIzaSyB0jxNMV27t28u0FNTyMKHgUaOhJ7NcWvo&sensor=false";
    const DITU_MAP_URI = '//ditu.google.cn/maps/api/js?key=AIzaSyB0jxNMV27t28u0FNTyMKHgUaOhJ7NcWvo&sensor=false';
    const DEFAULT_TYPEID = 'ROADMAP';  // available options: HYBRID, ROADMAP, SATELLITE, TERRAIN
    const DEFAULT_ZOOM_LEVEL = 15;
    const DEFAULT_RESPONSE_TYPE = 'html';

    const SERVICE_URI_LOCATION = '//teakettle.qa1.o.com/location/';
    const SERVICE_URI_HOTEL_CONTENT = 'http://teakettle.qa1.o.com/content/hotel/partial/en/AU';


    protected $apiModel;
    protected $apiUrl;

    protected $params;
    protected $longitute;
    protected $latitude;
    protected $mapWidth;
    protected $mapHeight;
    protected $mapTypeId;
    protected $mapZoomLevel;
    protected $mapLanguage;

    protected $locationId;
    protected $onegId;

    protected $clientRequest;
    protected $response;
    protected $provider;


    /**
     *
     */
    public function initialize()
    {
        $this->init();
    }

    /**
     *
     */
    public function init()
    {
        $this->view->disable();

        $this->setApiModel()->setParams();
        if (is_array($this->params) && count($this->params) > 0) {
            $this->setMapData();
        } else {
            $this->forward('Error/show404');
        }
    }

    /**
     * Encapusulation: Getters and Setters
     */

    /**
     * @return mixed
     */
    public function getApiModel()
    {
        if (null === $this->apiModel) {
            $this->setApiModel();
        }
        return $this->apiModel;
    }

    /**
     * @return $this
     */
    public function setApiModel()
    {
        $refererHost    = $this->getHttpRefererHost();
        $this->apiModel = $refererHost == 'hotelclub.cn' ? 'ditu' : self::DEFAULT_API_MODEL;

        $apiUrl = $this->apiModel === self::DEFAULT_API_MODEL ? self::GOOGLE_MAP_URI : self::DITU_MAP_URI;
        $this->setApiUrl($apiUrl);

        return $this;
    }

    /**
     * @return $this
     */
    public function getApiUrl()
    {
        if (null === $this->apiUrl) {
            $this->setApiUrl();
        }
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl($apiUrl = self::GOOGLE_MAP_URI)
    {
        $this->apiUrl = $apiUrl;
        return $this;
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
    public function getMapHeight()
    {
        if (null === $this->mapHeight) {
            $this->setMapHeight();
        }
        return $this->mapHeight;
    }

    /**
     * @param mixed $mapHeight
     * @return $this
     */
    public function setMapHeight($mapHeight = self::DEFAULT_MAP_HEIGHT)
    {
        $this->mapHeight = $mapHeight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapTypeId()
    {
        if (null === $this->mapTypeId) {
            $this->setMapTypeId();
        }
        return $this->mapTypeId;
    }

    /**
     * @param mixed $mapTypeId
     * @return $this
     */
    public function setMapTypeId($mapTypeId = self::DEFAULT_TYPEID)
    {
        $this->mapTypeId = $mapTypeId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapWidth()
    {
        if (null === $this->mapWidth) {
            $this->setMapWidth();
        }
        return $this->mapWidth;
    }

    /**
     * @param mixed $mapWidth
     * @return $this
     */
    public function setMapWidth($mapWidth = self::DEFAULT_MAP_WIDTH)
    {
        $this->mapWidth = $mapWidth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapZoomLevel()
    {
        if (null === $this->mapZoomLevel) {
            $this->setMapZoomLevel();
        }
        return $this->mapZoomLevel;
    }

    /**
     * @param int $mapZoomLevel
     * @return $this
     */
    public function setMapZoomLevel($mapZoomLevel = self::DEFAULT_ZOOM_LEVEL)
    {
        $this->mapZoomLevel = $mapZoomLevel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapLanguage()
    {
        if (null === $this->mapLanguage) {
            $this->setMapLanguage();
        }

        return $this->mapLanguage;
    }

    /**
     * @param string $mapLanguage
     * @return $this
     */
    public function setMapLanguage($mapLanguage = self::DEFAULT_MAP_LANGUAGE)
    {
        $this->mapLanguage = $mapLanguage;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @param mixed $locationId
     * @return $this
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitute()
    {
        return $this->longitute;
    }

    /**
     * @param $longitute
     * @return $this
     */
    public function setLongitute($longitute)
    {
        $this->longitute = $longitute;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnegId()
    {
        return $this->onegId;
    }

    /**
     * @param $onegId
     * @return $this
     */
    public function setOnegId($onegId)
    {
        $this->onegId = $onegId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientRequest()
    {
        return $this->clientRequest;
    }

    /**
     * @param mixed $clientRequest
     */
    public function setClientRequest($clientRequest)
    {
        $this->clientRequest = $clientRequest;
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
     * @return \Phalcon\Http\Response
     */
    public function getResponse()
    {
        if (null == $this->response) {
            $this->setResponse();
        }
        return $this->response;
    }

    /**
     * @return $this
     */
    public function setResponse()
    {
        $this->response = new Response();
        return $this;
    }


    /**
     * @param string $locale
     */
    protected function getGoogleLanguageByLocale($locale = self::DEFAULT_LOCALE)
    {

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
        $this->getResponse()
            ->setHeader("Content-Type", "text/html; charset=UTF-8")
            ->setRawHeader("HTTP/1.1 200 OK")
            ->setStatusCode(200, "OK")
            ->setContent($body)
            ->send();
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

    /**
     * @todo this method is messy use interface or something
     * @return $this
     */
    protected function setMapData()
    {
        switch ($this->dispatcher->getActionName()) {
            // matches: api/map/hotel/[oneg id]
            case 'hotel':
                $this->onegId      = $this->params[0];
                $this->mapWidth    = empty($this->params[1]) ? self::DEFAULT_MAP_WIDTH : $this->params[1];
                $this->mapHeight   = empty($this->params[2]) ? self::DEFAULT_MAP_HEIGHT : $this->params[2];
                $this->mapLanguage = empty($this->params[3]) ? self::DEFAULT_MAP_LANGUAGE : $this->params[3];
                $this->mapTypeId   = empty($this->params[4]) ? self::DEFAULT_TYPEID : $this->params[4];
                $this->mapZoomLevel   = empty($this->params[5]) ? self::DEFAULT_ZOOM_LEVEL : $this->params[5];

                // use lapsang api
                // http://teakettle.qa1.o.com/content/hotel/13902/en/HCL/BASIC

                break;

            // matches: api/map/location/[location id]
            case 'location':
                $this->locationId  = $this->params[0];
                $this->mapWidth    = empty($this->params[1]) ? self::DEFAULT_MAP_WIDTH : $this->params[1];
                $this->mapHeight   = empty($this->params[2]) ? self::DEFAULT_MAP_HEIGHT : $this->params[2];
                $this->mapLanguage = empty($this->params[3]) ? self::DEFAULT_MAP_LANGUAGE : $this->params[3];
                $this->mapTypeId   = empty($this->params[4]) ? self::DEFAULT_TYPEID : $this->params[4];
                $this->mapZoomLevel   = empty($this->params[5]) ? self::DEFAULT_ZOOM_LEVEL : $this->params[5];
                // use lapsang api
                // http://teakettle.qa1.o.com/location/509/en_AU
                break;

            // matches api/map/get/[long]/[lat]/[width]/[height]/MAP_TYPE_ID
            case 'get':
            default:
                $this->longitute   = $this->params[0];
                $this->latitude    = $this->params[1];
                $this->mapWidth    = empty($this->params[2]) ? self::DEFAULT_MAP_WIDTH : $this->params[2];
                $this->mapHeight   = empty($this->params[3]) ? self::DEFAULT_MAP_HEIGHT : $this->params[3];
                $this->mapLanguage = empty($this->params[4]) ? self::DEFAULT_MAP_LANGUAGE : $this->params[4];
                $this->mapTypeId   = empty($this->params[5]) ? self::DEFAULT_TYPEID : $this->params[5];
                $this->mapZoomLevel   = empty($this->params[6]) ? self::DEFAULT_ZOOM_LEVEL : $this->params[6];
                break;
        }
        return $this;
    }

    /**
     * @param        $requestUri
     * @param        $requestParams
     * @param string $context
     */
    protected function provideResponse($requestUri, $requestParams, $context = 'location')
    {
        $response = $this->getProviderResponse($requestUri, $requestParams);
        $responseBody = json_decode($response->body);

        $responseBody = $context == 'hotel' && !empty($responseBody->content_partials[0]) ? $responseBody->content_partials[0] : $responseBody;

        if ($this->parseCoordinates($responseBody)) {
            $this->sendResponse($this->getMapHtml());
        } else {
            $this->send404Response($context);
        }

    }

    /**
     * @param $responseBody
     * @return bool
     */
    protected function parseCoordinates($responseBody)
    {
        if (!empty($responseBody->coordinate)) {
            $this->longitute = $responseBody->coordinate->longitude;
            $this->latitude  = $responseBody->coordinate->latitude;
            return true;
        }

        return false;
    }

    /**
     * @param $requestUri
     * @param $requestParams
     * @return \Phalcon\Http\Client\Response
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    protected function getProviderResponse($requestUri, $requestParams)
    {
        $provider = Request::getProvider();
        $provider->setBaseUri(self::BASE_URL);
        $provider->header->set('Accept', 'application/json');
        return $provider->get($requestUri, $requestParams);
    }

    /**
     * @param bool $wrapHtml
     * @return string
     */
    protected function getMapHtml($wrapHtml = true)
    {
        $htmlHead = '
            <script src="' . $this->getApiUrl() . '&language=' . $this->getMapLanguage() . '"
            type="text/javascript"></script>
            <style type="text/css">
            html, body, #map-canvas { height:' . $this->getMapHeight() . 'px; width:' . $this->getMapWidth() . 'px; margin: 0; }
            </style>
            <script type="text/javascript">
            function initialize() {
            var map = new google.maps.Map(
            document.getElementById(\'map-canvas\'), {
            center: new google.maps.LatLng(' . $this->latitude . ',' . $this->longitute . '),
            zoom: '. $this->getMapZoomLevel() .',
            mapTypeId: google.maps.MapTypeId.' . $this->getMapTypeId() . '
            });

            var marker = new google.maps.Marker({
            position: new google.maps.LatLng(' . $this->latitude . ',' . $this->longitute . '),
            map: map
            });

            }
            google.maps.event.addDomListener(window, \'load\', initialize);
            google.maps.event.trigger(map, \'resize\');

            </script>';
        $htmlBody = '
            <div id="map-canvas"></div>
            </body>
            ';
        return $wrapHtml ?
            '<!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8">
            ' .
            $htmlHead . '
            </head>
            <body>' .
            $htmlBody . '
            </html>' :
            $htmlHead . $htmlBody;
    }

    /**
     *
     */
    public function indexAction()
    {

    }


    /**
     * default method, Render map based on co-ordinates
     */
    public function getAction()
    {
        $this->sendResponse($this->getMapHtml());

    }

    /**
     * Render map based on location id
     */
    public function locationAction()
    {
        $requestUri    = self::SERVICE_URI_LOCATION . $this->locationId . '/en_AU';
        $requestParams = [];

        $this->provideResponse($requestUri, $requestParams);
    }

    /**
     * Render map based on hotel oneg id
     */
    public function hotelAction()
    {
        $requestUri    = self::SERVICE_URI_HOTEL_CONTENT;
        $requestParams = [
            'hid'     => $this->onegId,
            'posCode' => 'hcl',
            'part'    => 'coreInfo'
        ];

        $this->provideResponse($requestUri, $requestParams, 'hotel');

    }



}
