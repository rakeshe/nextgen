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


    /**
     *
     */
    public function initialize()
    {
        $this->view->disable();
        $this->checkAuth();
        $this->setParams();
    }

    public function checkAuth() {
        return true;
    }

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
                if(is_numeric($val))
                    array_push($this->onegID, $val);
            }
        }
    }

    public function getLeadInfoFromPWS($onegID) {

        //create obj
        $provider = Request::getProvider();
        //set uri
        $provider->setBaseUri(self::ORBITZ_API_URL);
        //set header
        $provider->header->set('Accept', 'application/json+oww-hotel.v3');
        //set curl options
        $provider->setOptions([
            CURLOPT_USERPWD => ORBITZ_API_USR.':'.ORBITZ_API_PASSWD,
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
        echo $response->body;
    }

    private function loadTargetingLeads() {
        try{
            return require __DIR__ . '/../config/targetingLeads.php';
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function getHotelInfoAction() {

    }
}
