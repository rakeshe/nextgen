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


    private $locale;

    private $onegID = [];

    private $isWhiteListed = false;

    private $whiteListType;

    private $verifyToken = false;


    /**
     * init
     */
    public function initialize()
    {
        $this->view->disable();
        $this->checkAuth();
        $this->setParams();
    }

    /** Verify auth
     * @return bool
     */
    public function checkAuth() {
        // load white list client url file
        $list = require __DIR__ . '/../config/white_list_client_urls.php';


        if (isset($list[$this->request->getHttpHost()])) {
            $this->whiteListType = 'HOST';
            $this->isWhiteListed = true;

        } else if (isset($list[$this->request->getClientAddress()])) {
            $this->whiteListType = 'IP';
            $this->isWhiteListed = true;
        }

    }

    /**
     * To verify token
     * @return bool
     */

    public function verifyToken() {
        return true;
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
     * Request Action
     */
    public function getHotelInfoAction() {

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
        //pass querysting as array
        $response = $provider->get('',[
            //'checkIn' => 20150325,
            //'checkOut' => '20150328',
            'pos' => 'HCL',
            'contentDetails' => 'medium',
            'hotelId' => $onegID
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
        $cntMonth = $now->format('M'); // get current month in string formate

        //convert high season months to array formate
        $highSeason = explode(',' , $details['highSeason']);
        $highSeasonFlag = false; // flag

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
        }
        //return season price based on month
        if ($highSeasonFlag == true)
            return $details['highSeasonPrice'];
        else
            return $details['lowSeasonPrice'];
    }

    /*
     * Build xml response format
     */
    public function buildXmlResponse() {

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;

        //requestPricing - root element
        $productsTag = $doc->createElement('Products');
        $doc->appendChild($productsTag);

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
