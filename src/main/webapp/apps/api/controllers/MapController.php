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

use \Phalcon\Http\Client\Request as client;

class MapController extends ControllerBase
{

    const DEFAULT_MAP_WIDTH = 800;
    const DEFAULT_MAP_HEIGHT = 800;

    const DEFAULT_API_MODEL = 'google';

//    const GOOGLE_MAP_URI_HTTP_V2 = 'http://maps.google.com/maps?oe=utf-8&amp;file=api&amp;v=2&amp;client=gme-orbitz&amp;sensor=false';
    const GOOGLE_MAP_URI_HTTP = "//maps.googleapis.com/maps/api/js?key=AIzaSyB0jxNMV27t28u0FNTyMKHgUaOhJ7NcWvo&sensor=false";
    const DITU_MAP_URI_HTTP = '//ditu.google.cn/maps/api/js?key=AIzaSyB0jxNMV27t28u0FNTyMKHgUaOhJ7NcWvo&sensor=false';

    const DEFAULT_TYPEID = 'ROADMAP';  // available options: HYBRID, ROADMAP, SATELLITE, TERRAIN

    protected $responseType = 'json';
    protected $apiModel;
    protected $apiUrl;
    protected $dataIdentifier;
    protected $params;
    protected $longitute;
    protected $latitude;
    protected $mapWidth;
    protected $mapHeight;
    protected $mapTypeId;
    protected $locationId;
    protected $onegId;
    protected $clientRequest;


    public function initialize()
    {
        $this->init();

    }

    public function init()
    {
        $this->view->disable();
        $request             = new \Phalcon\Http\Request();
        $this->clientRequest =
        $referer = parse_url($request->getHTTPReferer());
        $this->apiUrl        = !empty($referer['host']) && $referer['host'] == 'hotelclub.cn' ? self::DITU_MAP_URI_HTTP : self::GOOGLE_MAP_URI_HTTP;
        $this->setParams();
        if (is_array($this->params) && count($this->params) > 0) {
            $this->setMapData();
        } else {
            $this->forward('Error/show404');

        }

    }

    public function getParams()
    {
        if ($this->params === null) {
            $this->setParams();
        }
        return $this->params;
    }

    public function setParams()
    {
        $this->params = $this->dispatcher->getParams();
    }

    protected function sendResponse($body)
    {
        $response = new \Phalcon\Http\Response();
        $response->setHeader("Content-Type", "text/html; charset=UTF-8");
        $response->setRawHeader("HTTP/1.1 200 OK");
        $response->setStatusCode(200, "OK");
        $response->setContent($body);
        $response->send();
    }

    protected function setMapData()
    {
        switch ($this->dispatcher->getActionName()) {
            // matches: api/map/hotel/[oneg id]
            case 'hotel':
                $this->onegId = $this->params[0];
                // use lapsang api
                // http://teakettle.qa1.o.com/content/hotel/13902/en/HCL/BASIC

                break;

            // matches: api/map/location/[location id]
            case 'location':
                $this->locationId = $this->params[0];
                // use lapsang api
                // http://teakettle.qa1.o.com/location/509/en_AU
                break;

            // matches api/map/get/[long]/[lat]/[width]/[height]/MAP_TYPE_ID
            case 'get':
            default:
                $this->longitute = $this->params[0];
                $this->latitude  = $this->params[1];
                $this->width     = empty($this->params[2]) ? self::DEFAULT_MAP_WIDTH : $this->params[2];
                $this->height    = empty($this->params[3]) ? self::DEFAULT_MAP_HEIGHT : $this->params[3];
                $this->mapTypeId = empty($this->params[4]) ? self::DEFAULT_TYPEID : $this->params[4];
                break;
        }
    }


    public function indexAction()
    {

    }


    public function getAction()
    {
        $htmlBody = '
            <!DOCTYPE html>
            <html>
            <head>
            <script src="' . $this->apiUrl . '"
            type="text/javascript"></script>
            <style type="text/css">
            html, body, #map-canvas { height:' . $this->height . 'px; width:' . $this->width . 'px; margin: 0; }
            </style>
            <script type="text/javascript">
            function initialize() {
            var map = new google.maps.Map(
            document.getElementById(\'map-canvas\'), {
            center: new google.maps.LatLng(' . $this->latitude . ',' . $this->longitute . '),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.' . $this->mapTypeId . '
            });

            var marker = new google.maps.Marker({
            position: new google.maps.LatLng(' . $this->latitude . ',' . $this->longitute . '),
            map: map
            });

            }
            google.maps.event.addDomListener(window, \'load\', initialize);
            google.maps.event.trigger(map, \'resize\');

            </script>
            </head>
            <body>
            <div id="map-canvas"></div>
            </body>
            </html>';

        $this->sendResponse($htmlBody);

    }

    public function locationAction()
    {

    }


    public function hotelAction()
    {

    }


}
