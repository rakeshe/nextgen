<?php

/**
 *
 * @package    Index controller
 * @author     K.N. Santosh Hegde
 * @since      24/7/2014
 * @version    1.0
 */

namespace HC\TI\Controllers;

class IndexController extends ControllerBase {

    private $translation;
    private $searchForm;
    private $azPricingGW;
    private $azPurchasingGWForAU;
    private $azPurchasingGWForNZ;   

    public function initialize() {
       //Load classes which is required each request
        $this->searchForm = new \HC\Forms\SearchForm();       
    }
    
    /**
     * Loading first time
     */
    public function init() {
        
        require_once __DIR__ . '/../language/' . $this->getLang() . '.php';       
        $this->translation = new \HC\Library\Translation($this->getLang(), 
                $messages); 
        $this->view->setTemplateAfter('main');         
        \Phalcon\Tag::setTitle($this->translation->getTranslation()->_('set-title'));
               
    }

    /**
     * Get user language
     * @return string
     */
    public function getLang() {
        return 'en';
    }

    /**
     * 
     * Default action
     */
    public function indexAction() {

        if ($this->request->isAjax() && $this->request->isPost()) {

            if ($this->searchForm->isValid($this->request->getPost()) != false) {
                if ($data = $this->dateValidation()) {
                    $this->displayError($data);
                }
                $this->getPriceDetails();
            } else {
                $this->displayError();
            }
            return;
        }
        // load classes
        $this->init(); 
        //set variable for view
        $this->view->setVars(array(
            'searchBoxConf'         => $this->config->searchConfig,
            't'                     => $this->translation->getTranslation(),
            'form'                  => $this->searchForm,
            'menuItemsTop'          => $this->config->menuItems->top,
            'menuItemsSite'         => $this->config->menuItems->site,            
            'menuItemsAccount'      => $this->config->menuItems->account,
            'destination'           => json_encode($this->config->destination),
            'languageCode'          => ''
        ));
    }

    /**
     * To display validation errors
     */
    public function displayError($data = false) {
        $msg = [];
        foreach ($this->searchForm->getMessages() as $message)
            $msg[] = $message->getMessage();

        if ($data != false)
            $msg[] = $data;
        die(json_encode(array('error' => $msg)));
    }

    /**
     * Sending the request to api and get the response
     */
    public function getPriceDetails() {
        //getting api settings        
        $apiConfig = $this->config->searchConfig->APIData;       

        $this->loadGateWayUrls(); // load gateway urls        
        $apiConfig = $this->config->searchConfig->APIData; //getting api settings         
        $priceModel = new \HC\TI\Models\PricingModel(); // pricing api model
        $nowObj = new \DateTime();
        $now = $nowObj->format('d/m/Y');

        //setting all data to the model class variable
        $priceModel->pricingGatewayUrl = $this->azPricingGW;
        $priceModel->securityKey = $apiConfig['securityKey'];
        $priceModel->partnerName = $apiConfig['partnerName'];
        $priceModel->country = $this->request->getPost('ddlcountry', 'string');
        $priceModel->issueDate = $now;
        $priceModel->saleOrigin = $apiConfig['saleOrigin'];
        $priceModel->language = 'en';
        $priceModel->startDate = $this->request->getPost('dStartDate', 'string');
        $priceModel->endDate = $this->request->getPost('dEndDate', 'string');
        $priceModel->travelType = $apiConfig['travelType'];
        $priceModel->originLocation = $this->request->getPost('ddlcountry', 'string');
        $priceModel->destLocation = $this->request->getPost('DES');
        $priceModel->numDependent = $this->request->getPost('ddlChild', 'int');
        $priceModel->dob = array_filter($this->request->getPost('AdobOne', 'string'));
        $priceModel->couponCode = $this->request->getPost('couponCode', array('alphanum', 'trim'));
        $priceModel->setAgeCats(); //count the travelers        
        $priceModel->buildXML(); //build the xml form

        if ($dom = $priceModel->doRequest()) {

            $xml = (array) simplexml_load_string($dom);
            if (isset($xml['error'])) {
                $error = $this->loadErrorHandler($xml['error']);
                die(json_encode(array('error' => $error)));
            } else if (isset($xml['benefits']) && is_object($xml['benefits'])) {
                $var = (array) $xml['benefits'];
                $result = array();
                foreach ($var['benefit'] as $val) {

                    $type = (strpos($val->label, 'Plan A') === false ) ? 'B' : 'A';
                    $result = $this->getDomParser($val->description, $type, $result);
                }
                unset($xml['benefits']); //remove benefites table               
                $xml['inputData'] = array(
                    'azPurchasingGW' => ($priceModel->country == 'NZ') ? $this->azPurchasingGWForNZ : $this->azPurchasingGWForAU,
                    'couponCode' => ($priceModel->couponCode != '') ? $priceModel->couponCode : '',
                    'destinationCode' => $this->getRegionCode($priceModel->destLocation, $priceModel->country),
                    'departureDate' => $priceModel->startDate,
                    'returnDate' => $priceModel->endDate,
                    'numberOfDependent' => $priceModel->numDependent,
                    'numberOfChildren' => $priceModel->numChild,
                    'numberOfAdult' => $priceModel->numAdult,
                    'numberOfSenior' => $priceModel->numSenior,
                    'numberOfSenior1' => $priceModel->numSenior1,
                    'numberOfSenior2' => $priceModel->numSenior2,
                    'numberOfSenior3' => $priceModel->numSenior3
                );
                $xml['json_benefits'] = $result;
                die(json_encode($xml));
            }
        }
        die(json_encode(array('error' => 'Error occurred try again!!!')));
    }

    private function loadErrorHandler($obj) {
        switch ($obj->errorCode) {
            case 'ERRINT_PROMO_INVALID' :
                return 'Your promo code is invalid!!';
            case 'ERROR_AUTHENTICATION' :
                break;
            default :
                return 'Error occurred try again';
        }
    }

    /**
     * To Parse Benifit data.
     * @param simple_html_dom $html
     * @param string $type plan name A or B
     * @param array $result pass the output array
     * @return array
     */
    public function getDomParser($html, $type, $result = array()) {

        $ht = str_replace('[', '<', $html);
        $ht = str_replace(']', '>', $ht);
        $ht = str_replace('^', '', $ht);

        $html = new \simple_html_dom();
        $html->load($ht);
        foreach ($html->find('table td[width=30]') as $val) {
            if (!array_key_exists($val->next_sibling()->plaintext, $result)) {
                $result[$val->next_sibling()->plaintext] = array($type => array($val->next_sibling()->next_sibling()->plaintext));
            } else {
                $result[$val->next_sibling()->plaintext][$type] = [];
                array_push($result[$val->next_sibling()->plaintext][$type], $val->next_sibling()->next_sibling()->plaintext);
            }
        }
        return $result;
    }

    /**
     * To set the api urls
     */
    public function loadGateWayUrls() {
        //getting api settings        
        $apiConfig = $this->config->searchConfig->APIData;

        //using the gateway url depend on the environment
        if ($apiConfig['environment'] == 'live')
            $data = $this->config->searchConfig->liveGateWay;
        elseif ($apiConfig['environment'] == 'staging')
            $data = $this->config->searchConfig->stagingGateWay;

        $this->azPricingGW          = $data['AllianzPricingGateway'];
        $this->azPurchasingGWForAU  = $data['AllianzPurchasingGatewayForAU'];
        $this->azPurchasingGWForNZ  = $data['AllianzPurchasingGatewayForNZ'];
    }

    /**
     * To get the resk leavel. risk leavel are defind in config.ini
     * 
     * @param array $destination 
     * @param string $country from country
     * @return string
     */
    private function getRegionCode($destination, $country) {

        $minRisk = 1;
        $regionRisk = (array) $this->config->regionRisk[$country];
        foreach ($destination as $val) {
            if (in_array($val, $regionRisk)) {
                $minRisk = array_search($val, $regionRisk);
            }
        }
        return $this->config->regionCode[$minRisk];
    }

    /**
     * 
     * date validation for searchform
     * @param string $date from date
     * @return string
     */
    public function dateValidation() {
        $dobs = $this->request->getPost('AdobOne');
        $adut = $this->request->getPost('ddlAdult', 'int');
        $flag = false;
        for ($i = 0; $i < $adut; $i++) {
            if (!isset($dobs[$i]) || $dobs[$i] == '')
                $flag = true;
        }
        if ($flag == false)
            return false; // field is valid
        return 'Please Enter Date of Birth'; // field is not valid
    }

}
