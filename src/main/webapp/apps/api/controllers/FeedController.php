<?php
/**
 *
 * @package    FeedController.php
 * @author     Santosh Hegde
 * @since      2/3/15 11:59 AM
 * @version    1.0
 */


namespace HC\Api\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class FeedController extends ControllerBase
{

    const ORBITZ_API_URL = 'https://ws.orbitzworldwide.com/hotels';

    const DEFAULT_LOCALE = 'en_AU';

    const ORBITZ_API_USR = '9acf2326f1da4e3e8af154cd3ee50efa';

    const ORBITZ_API_PASSWD = '4f4fca707c504edd93306613388e886a';

    const RESPONSE_CONTENT_TYPE = 'application/xml';

    private $locale;

    private $onegID = [];

    private $isWhiteListed = false;

    private $whiteListType;

    private $verifyToken = false;

    private $userWhiteListedData = [];

    private $responseContentType;

    private $checkOutDate;

    private $checkInDate;

    private $response;

    private $cacheDocName;

    /**
     * init
     */
    public function initialize() {

        $this->init();
        $this->loadWhiteListData();
        $this->checkAuth();
        $this->setParams();
        $this->verifyOnegID();
    }

    public function init() {

        $this->view->disable(); // disable view
    }

    /** Verify auth
     * @return bool
     */
    private function checkAuth() {

        if (false === $this->verifyHost()) {
            $this->responseContentType = 'text/html';
            $this->sendOutput('401 Unauthorized');
        }

        if (false === $this->verifyToken()) {


            $doc = new \DOMDocument('1.0', 'UTF-8');
            $doc->formatOutput = true;

            $message = $doc->createElement('message');
            $doc->appendChild($message);

            $errorValue = $doc->createElement('value');
            $errorValue->appendChild($doc->createTextNode("Token is invalid"));
            $message->appendChild($errorValue);

            $errorCode = $doc->createElement('errorCode');
            $errorCode->appendChild($doc->createTextNode("INVALID_TOKEN"));
            $message->appendChild($errorCode);

            $this->sendOutput('200 OK', $doc->saveXML());
        }
    }

    private function verifyHost() {

        if (null !== $this->request->getHttpHost() && array_key_exists($this->request->getHttpHost(), $this->userWhiteListedData)) {
            $this->whiteListType = 'HOST';
            $this->isWhiteListed = true;
            return true;
        } else if (isset($this->userWhiteListedData[$this->request->getClientAddress()])) {
            $this->whiteListType = 'IP';
            $this->isWhiteListed = true;
            return true;
        }
        return false;
    }

    /**
     * There is a known bug in phalcon get header function, So using alternative
     * $this->request->getHeader('Authorization')
     *
     * To verify token
     * @return bool
     */

    public function verifyToken() {

        if (isset(getallheaders()['Authorization']) && null != getallheaders()['Authorization']) {

            if (trim(getallheaders()['Authorization']) ===
                $this->userWhiteListedData[$this->request->getHttpHost()]) {

                $this->verifyToken = true;
                return true;  //token is valid
            }
        }
        return false;
    }

    private function sendOutput($httpCode, $content = false) {

        $res = new Response;
        $res
            ->setHeader("Content-Type", "{$this->responseContentType}; charset=UTF-8")
            ->setRawHeader("HTTP/1.1 {$httpCode}")
            ->setStatusCode($httpCode,'')
            ->setContent($content)
            ->send();
        die();
    }

    /**
     * Load user white list data
     */
    private function loadWhiteListData() {

        try{
            $this->userWhiteListedData = require __DIR__ . '/../config/white_list_client_urls.php';
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     *  verify input data and set
     */
    public function setParams() {

        //check and validate incoming locale
        if (null !== $this->request->getQuery('locale') &&
            isset($this->config->googleLanguage[$this->request->getQuery('locale')])) {
                $this->locale = $this->request->getQuery('locale');
        } else {
            $this->locale = self::DEFAULT_LOCALE;
        }

        //set response format xml or json
        $this->responseContentType = self::RESPONSE_CONTENT_TYPE;
        //set cache document name
        $this->cacheDocName = 'cache:'. md5('api-response-framework'). ':' . $this->locale;

        //check and set the incoming onegid
        if (null !== $this->request->getQuery('oneg')) {

            foreach(explode(',', $this->request->getQuery('oneg')) as $val) {

                //check if onegid is available in our lead array
                if(is_numeric($val) &&  isset($this->loadTargetingLeads()[$val]))
                    $this->onegID[$val] = $val;
            }
        }
        //set checkin and checkout date
        $this->checkInDate = \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))->modify('+1 day')->format('Ymd');
        $this->checkOutDate = \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))->modify('+2 day')->format('Ymd');
    }

    /**
     * Verify requested onegID is valid or not, If it's invalid send the error code to user
     * @return bool
     */

    private function verifyOnegID() {

        if (null !== $this->request->getQuery('oneg')) {

            if (count(array_filter($this->onegID)) == 0) {

                $doc = new \DOMDocument('1.0', 'UTF-8');
                $doc->formatOutput = true;

                $message = $doc->createElement('message');
                $doc->appendChild($message);

                $errorValue = $doc->createElement('value');
                $errorValue->appendChild($doc->createTextNode("Property unavailable"));
                $message->appendChild($errorValue);

                $errorCode = $doc->createElement('errorCode');
                $errorCode->appendChild($doc->createTextNode("NO_RESULTS_FOUND"));
                $message->appendChild($errorCode);

                $this->sendOutput('200 OK', $doc->saveXML());
            }
        }
        return true;
    }

    private function getResponseFormat($pwsDetail) {

        $response = [];
        foreach( $pwsDetail->hotels->hotel as $key => $value) {

            $image = false;
            $thImg = '';
            foreach ($value->details->content->media as $media) {

                if (!isset($media->title)) {
                    continue;
                }

                if (strpos($media->title, '-Guest-Room') !== false && $image == false) {
                    $image = $media->value;
                }

                if ($media->type == 'thumbnail') {
                    $thImg = $media->value;
                }
            }

            $this->response[$value->details->id] = [
                'onegid'    => $value->details->id,
                'HotelName' => $value->details->name,
                'City'      => $value->details->address->city,
                'Price'     => $this->getHotelSeasonalPrice($value->details->id),
                'Image'     => $image,
                'Thumbnail' => $thImg,
                'URL'       => $value->rooms->roomRates[0]->roomRate[0]->href
            ];

        }

        return $this->response;

    }


    /**
     * Request Action
     */
    public function getHotelInfoAction() {

        $loop =  (count($this->onegID) > 0) ? $this->onegID : $this->loadTargetingLeads();

        $isCacheEnabled = false;
        if(in_array($this->locale, (array) $this->config->cacheConfig->enableCacheLocale)) {
            $isCacheEnabled = true;
        }

        //if cache enabled
        if (true == $isCacheEnabled) {

            //get the instance from di
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];

            //get the data from cache
            $cacheData   = json_decode($Couch->get($this->cacheDocName), true);

            $missingOnegId = []; // to store missing onegid in cache

            foreach($loop as $key => $id) {

                if(array_key_exists($key, $cacheData)) {

                    $this->response[$key] = $cacheData[$key];
                } else {
                    array_push($missingOnegId, $key);
                }
            }

            //if missing onegid is exists, get the data from PWS server
            if (count($missingOnegId) > 0) {

                //get the data from PWS
                $pwsDetail  = $this->getLeadInfoFromPWS(implode(',', $missingOnegId));

                if (false !== $pwsDetail) {

                    $this->getResponseFormat($pwsDetail);
                    //store in couch document
                    $Couch->set($this->cacheDocName, json_encode($this->response), $this->config->cacheConfig->documentLifetime);
                }
            }

        } else {

            $pwsDetail = $this->getLeadInfoFromPWS(implode(',', array_keys($loop)));

            if (false !== $pwsDetail) {
                $this->getResponseFormat($pwsDetail);;
            }
        }

        if (count($this->response) > 0) {
            //get xml response
            $xmlBody = $this->buildXmlResponse();
            //send output
            $this->sendOutput('200 OK', $xmlBody);

        } else {

            $doc = new \DOMDocument('1.0', 'UTF-8');
            $doc->formatOutput = true;

            $message = $doc->createElement('message');
            $doc->appendChild($message);

            $errorValue = $doc->createElement('value');
            $errorValue->appendChild($doc->createTextNode("Property unavailable"));
            $message->appendChild($errorValue);

            $errorCode = $doc->createElement('errorCode');
            $errorCode->appendChild($doc->createTextNode("NO_RESULTS_FOUND"));
            $message->appendChild($errorCode);

            $this->sendOutput('200 OK', $doc->saveXML());
        }
    }

    /**
     * Get information about hotel
     * @param int $onegID
     * @return json
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public function getLeadInfoFromPWS($onegID) {

        try {
            //create obj
            $provider = Request::getProvider();
            //set uri
            $provider->setBaseUri(self::ORBITZ_API_URL);
            //set header
            $provider->header->set('Accept', 'application/json+oww-hotel.v3');
            //set curl options
            $provider->setOptions([
                CURLOPT_USERPWD => self::ORBITZ_API_USR . ':' . self::ORBITZ_API_PASSWD,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_RETURNTRANSFER => true,
            ]);
            $provider->setTimeout(60);
            //pass querysting as array
            $response = $provider->get('', [
                'checkIn' => $this->checkInDate,
                'checkOut' => $this->checkOutDate,
                'pos' => 'HCL',
                'contentDetails' => 'medium',
                'hotelId' => $onegID,
                'locale' => $this->locale
            ]);
            //get result
            return $this->validatePWSResponse(
                json_decode($response->body), $onegID);

        } catch (\Exception $e){
            echo $e->getMesage();
            return false;
        }
    }

    /**
     * To check is any error in response
     * @param json object $responses
     * @param string $onegIds
     * @return bool
     */

    private function validatePWSResponse($responses, $onegIds) {

        //check error in result
        if (isset($responses->message)) {

            //checking error code
            switch($responses->message->errorCode) {

                case 'NO_RESULTS_FOUND':
                default:
                $this->getDI()->getShared('logger')->log("PWS API Response Error: key => {$responses->message->errorCode}
                    value=> {$responses->message->value}");
                break;
            }
            return false;
        }
        return $responses;
    }

    /**
     * load lead (onegid) file
     */
    private function loadTargetingLeads() {
        try{
            return require __DIR__ . '/../config/targetingLeads.php';
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * To get seasonal price based on current month
     * @param int $onegId
     * @return number
     */
    public function getHotelSeasonalPrice($onegId) {

        $details = $this->loadTargetingLeads()[$onegId]; // get lead details
        $now = new \DateTime('now');
        $cntMonth = $now->format('m'); // get current month in string formate

        //convert high season months to array format
        $highSeason = explode(',' , $details['high_months']);
        $highSeasonFlag = false; // flag

        foreach($highSeason as $HSM) {

            if (trim($HSM) == $cntMonth) {
                $highSeasonFlag = true;
                break;
            }
        }

        if ($highSeasonFlag == true)
            return $details['price_high'];
        else
            return $details['price_low'];

    }

    /**
     * Create XML header object and returns both (doc and parent tag)
     * @return array
     */

    private function getXMLHeader() {

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;

        //requestPricing - root element
        $productsTag = $doc->createElement('Products');
        $doc->appendChild($productsTag);

        return [$doc, $productsTag];
    }

    /*
     * Build xml response format
     */
    public function buildXmlResponse() {

        list($doc, $productsTag) = $this->getXMLHeader();

        foreach($this->response as $key => $value) {

            //version Tag
            $versionTag = $doc->createElement('Versions');
            $productsTag->appendChild($versionTag);

            //HotelName tag
            $hotelNameTag = $doc->createElement('HotelName');
            $hotelNameTag->appendChild(
                $doc->createTextNode($value['HotelName'])
            );
            $versionTag->appendChild($hotelNameTag);

            //City Tag
            $cityTag = $doc->createElement('City');
            $cityTag->appendChild(
                $doc->createTextNode($value['City'])
            );
            $versionTag->appendChild($cityTag);

            //Price Tag
            $priceTag = $doc->createElement('Price');
            $priceTag->appendChild(
                $doc->createTextNode($value['Price'])
            );
            $versionTag->appendChild($priceTag);

            //Image Tag
            $imageTag = $doc->createElement('Image');
            $imageTag->appendChild(
                $doc->createTextNode($value['Image'])
            );
            $versionTag->appendChild($imageTag);

            //Thumbnail Tag
            $thumbnailTag = $doc->createElement('Thumbnail');
            $thumbnailTag->appendChild(
                $doc->createTextNode($value['Thumbnail'])
            );
            $versionTag->appendChild($thumbnailTag);

            //Image Tag
            $urlTag = $doc->createElement('URL');
            $urlTag->appendChild(
                $doc->createTextNode($value['URL'])
            );
            $versionTag->appendChild($urlTag);
        }
       return $doc->saveXML();
    }

    public function buildJSONResponse() {

    }

}
