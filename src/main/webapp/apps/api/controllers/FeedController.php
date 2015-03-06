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
        //set response format
        $this->responseContentType = self::RESPONSE_CONTENT_TYPE;
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

            // get HML header objects
            list($doc, $parent) = $this->getXMLHeader();

            $errorTag = $doc->createElement('Error');

            $errorTag->appendChild($doc->createTextNode("INVALID TOKEN"));

            $parent->appendChild($errorTag);

            $this->sendOutput('200 OK', $doc->saveXML());
        }
    }

    private function verifyHost() {

        if (isset($this->userWhiteListedData[$this->request->getHttpHost()])) {
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

        if (isset(getallheaders()['Authorization']) && !empty(getallheaders()['Authorization'])) {

            if (trim(getallheaders()['Authorization']) ===
                $this->userWhiteListedData[$this->request->getHttpHost()]) {
                $this->verifyToken = true;
                //token is valid
                return true;
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

        $this->userWhiteListedData = require __DIR__ . '/../config/white_list_client_urls.php';
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

        //check and set the incoming onegid
        if (null !== $this->request->getQuery('oneg')) {

            foreach(explode(',', $this->request->getQuery('oneg')) as $val) {

                //check if onegid is available in our lead array
                if(is_numeric($val) &&  isset($this->loadTargetingLeads()[$val]))
                    $this->onegID[$val] = $val;
            }
        }
    }

    /**
     * Verify requested onegID is valid or not, If it's invalid send the error code to user
     * @return bool
     */

    private function verifyOnegID() {

        if (null !== $this->request->getQuery('oneg')) {

            if (count(array_filter($this->onegID)) == 0) {

                // get HML header objects
                list($doc, $parent) = $this->getXMLHeader();

                $errorTag = $doc->createElement('Error');

                $errorTag->appendChild($doc->createTextNode("INVALID HOTEL ID"));

                $parent->appendChild($errorTag);

                $this->sendOutput('200 OK', $doc->saveXML());
            }
        }
        return true;
    }


    /**
     * Request Action
     */
    public function getHotelInfoAction() {

        $this->checkInDate = \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))->modify('+1 day')->format('Ymd');
        $this->checkOutDate = \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))->modify('+2 day')->format('Ymd');

        //$pwsDetail  = json_decode($this->getLeadInfoFromPWS($key)); // get info from PWS

        $loop =  (count($this->onegID) > 0) ? $this->onegID : $this->loadTargetingLeads();

        /*echo "<pre>";
        echo 'working..';
        $onegIDs = implode(',', array_keys($loop));
        $pwsDetail  = json_decode($this->getLeadInfoFromPWS($onegIDs)); // get info from PWS
        print_r($pwsDetail);
        exit;*/

        $res = new Response;
        $res
            ->setHeader("Content-Type", "application/xml; charset=UTF-8")
            ->setRawHeader("HTTP/1.1 200 OK")
            ->setStatusCode(200, "OK")
            ->setContent($this->buildXmlResponse())
            ->send();
    }

    /**
     * Get information about hotel
     * @param int $onegID
     * @return json
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public function getLeadInfoFromPWS($onegID) {

        //create obj
        $provider = Request::getProvider();
        //set uri
        $provider->setBaseUri(self::ORBITZ_API_URL);
        //set header
        $provider->header->set('Accept', 'application/json+oww-hotel.v3');
        //set curl options
        $provider->setOptions([
            CURLOPT_USERPWD => self::ORBITZ_API_USR.':'.self::ORBITZ_API_PASSWD,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $provider->setTimeout(60);
        //pass querysting as array
        $response = $provider->get('',[
            'checkIn' => $this->checkInDate,
            'checkOut' => $this->checkOutDate,
            'pos' => 'HCL',
            'contentDetails' => 'medium',
            'hotelId' => $onegID,
            'locale' => $this->locale
        ]);
        //get result
        return $response->body;
    }

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
        /*
           foreach($highSeason as $HSM) {

                //if current month
                if (trim($HSM) == $cntMonth) {
                    $highSeasonFlag = true;

                  // if between months ex (Jan - Mar)
                } else if (strpos($HSM, '-') !== false) {
                    //convert starting month and ending months to array
                    $betweenMonth = explode('-' , $HSM);

                    //convert from string format month to numeric format
                    $currentMonth = date('m', strtotime($cntMonth));
                    $startMonth = date('m', strtotime(trim($betweenMonth[0])));
                    $endMonth   = date('m', strtotime(trim($betweenMonth[1])));

                    //check weather it is in between month
                    if ($currentMonth >= $startMonth && $currentMonth <= $endMonth) {
                        $highSeasonFlag = true;
                    }
                }
            }*/
        //return season price based on month

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

        //assign which array should be execute (all data from lead file or requested onegid)
        $loop =  (count($this->onegID) > 0) ? $this->onegID : $this->loadTargetingLeads();

        foreach( $loop as $key => $id) {

            //$onegId     = $key; //hotel ID
            $price      = $this->getHotelSeasonalPrice($key);  //seasonal price
            $pwsDetail  = json_decode($this->getLeadInfoFromPWS($key)); // get info from PWS

            $image = false;
            $thImg = '';
            foreach($pwsDetail->hotels->hotel[0]->details->content->media as $media) {

                if (strpos($media->title, '-Guest-Room') !== false && $image == false) {
                    $image = $media->value;
                }

                if ($media->type == 'thumbnail') {
                    $thImg = $media->value;
                }
            }

            //version Tag
            $versionTag = $doc->createElement('Versions');
            $productsTag->appendChild($versionTag);

            //HotelName tag
            $hotelNameTag = $doc->createElement('HotelName');
            $hotelNameTag->appendChild(
                $doc->createTextNode($pwsDetail->hotels->hotel[0]->details->name)
            );
            $versionTag->appendChild($hotelNameTag);

            //City Tag
            $cityTag = $doc->createElement('City');
            $cityTag->appendChild(
                $doc->createTextNode($pwsDetail->hotels->hotel[0]->details->address->city)
            );
            $versionTag->appendChild($cityTag);

            //Price Tag
            $priceTag = $doc->createElement('Price');
            $priceTag->appendChild(
                $doc->createTextNode($price)
            );
            $versionTag->appendChild($priceTag);

            //Image Tag
            $imageTag = $doc->createElement('Image');
            $imageTag->appendChild(
                $doc->createTextNode($image)
            );
            $versionTag->appendChild($imageTag);

            //Thumbnail Tag
            $thumbnailTag = $doc->createElement('Thumbnail');
            $thumbnailTag->appendChild(
                $doc->createTextNode($thImg)
            );
            $versionTag->appendChild($thumbnailTag);

            //Image Tag
            $urlTag = $doc->createElement('URL');
            $urlTag->appendChild(
                $doc->createTextNode($pwsDetail->hotels->hotel[0]->rooms->roomRates[0]->roomRate[0]->href)
            );
            $versionTag->appendChild($urlTag);
        }

       return $doc->saveXML();
    }
}
