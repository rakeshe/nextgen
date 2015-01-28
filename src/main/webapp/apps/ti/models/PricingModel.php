<?php

/**
 *
 * @package    Pricing Module
 * @author     K.N. Santosh Hegde
 * @since      16/5/2014
 * @version    1.0
 */
namespace HC\TI\Models;
class PricingModel extends \Phalcon\Mvc\Model {

    public $securityKey;
    public $partnerName;
    public $country;
    public $issueDate;
    public $saleOrigin;
    public $language = 'en';
    public $startDate;
    public $endDate;
    public $travelType;
    public $originLocation;
    public $destLocation = array();
    public $numDependent = 0;
    public $numChild = 0;
    public $numAdult = 0;
    public $numSenior = 0;
    public $numSenior1 = 0;
    public $numSenior2 = 0;
    public $numSenior3 = 0;
    public $dob = array();
    public $pricingGatewayUrl;
    public $xmlPostFildes;
    public $couponCode = null;

    /**
     * Categorise the people based on date of birth
     * 
     */
    public function setAgeCats() {

        foreach ($this->dob as $val) {

            list($date, $month, $year) = explode('/', $val);
            $datetime = new \DateTime($year . '-' . $month . '-' . $date);
            $interval = $datetime->diff(new \DateTime());
            $years = $interval->format('%y');

            if ($years < 18)                        //Age of Child between 0 and 20	
                $this->numChild++;
            elseif ($years >= 18 && $years <= 59)   //Age of Adult between 21 and 59
                $this->numAdult++;
            elseif ($years >= 60 && $years <= 69)   //Age of Senior between 60 and 69
                $this->numSenior++;
            elseif ($years >= 70 && $years <= 74)   //Age of Senior between 70 and 74
                $this->numSenior1++;
            elseif ($years >= 75 && $years <= 79)   //Age of Senior between 75 and 79
                $this->numSenior2++;
            elseif ($years >= 80 && $years <= 85)   //Age of Senior between 80 and 85
                $this->numSenior3++;
        }
    }

    /**
     * To Request remote domain
     * @return xml
     */
    public function doRequest() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_URL, $this->pricingGatewayUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xmlPostFildes);
        curl_setopt($ch, CURLOPT_POST, 1);
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            $result = false;
            $this->getDI()->getShared('logger')->log("Curl Error: " . curl_errno($ch) .": ".
                    curl_error($ch));

        } else {
            $result = $data;
            }

        curl_close($ch);
        return $result;
    }

    /**
     * To build the xml body
     * @return XML
     */
    public function buildXML() {

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;

        //requestPricing - root element
        $requestPricing = $doc->createElement('requestPricing');
        $requestPricing->setAttribute('xmlns', 'http://www.mondial-assistance.com/ecommerce/schema/');
        $doc->appendChild($requestPricing);

        //adminValues
        $adminValues = $doc->createElement('adminValues');
        $requestPricing->appendChild($adminValues);

        $securityKey = $doc->createElement('securityKey');
        $securityKey->appendChild(
                $doc->createTextNode($this->securityKey)
        );
        $adminValues->appendChild($securityKey);

        $partnerName = $doc->createElement('partnerName');
        $partnerName->appendChild(
                $doc->createTextNode($this->partnerName)
        );
        $adminValues->appendChild($partnerName);

        $country = $doc->createElement('country');
        $country->appendChild(
                $doc->createTextNode($this->country)
        );
        $adminValues->appendChild($country);

        $issueDate = $doc->createElement('issueDate');
        $issueDate->appendChild(
                $doc->createTextNode($this->issueDate)
        );
        $adminValues->appendChild($issueDate);

        $salesOrigin = $doc->createElement('salesOrigin');
        $salesOrigin->setAttribute('type', 'WL');
        $salesOrigin->appendChild(
                $doc->createTextNode($this->saleOrigin)
        );
        $adminValues->appendChild($salesOrigin);

        $language = $doc->createElement('language');
        $language->appendChild(
                $doc->createTextNode($this->language)
        );
        $adminValues->appendChild($language);

        $parameters = $doc->createElement('Parameters');
        $adminValues->appendChild($parameters);

        $parameter = $doc->createElement('Parameter');
        $parameter->setAttribute('name', 'No_Of_Dependent');
        $parameter->setAttribute('value', $this->numDependent); // value
        $parameters->appendChild($parameter);

        //promo code
        $param = $doc->createElement('Parameter');
        $param->setAttribute('name', 'promotionCode');
        $param->setAttribute('value', $this->couponCode); // value
        $parameters->appendChild($param);

        //travelDescription
        $travelDescription = $doc->createElement('travelDescription');
        $requestPricing->appendChild($travelDescription);

        $startDate = $doc->createElement('startDate');
        $startDate->appendChild(
                $doc->createTextNode($this->startDate)
        );
        $travelDescription->appendChild($startDate);

        $endDate = $doc->createElement('endDate');
        $endDate->appendChild(
                $doc->createTextNode($this->endDate)
        );
        $travelDescription->appendChild($endDate);

        $travelType = $doc->createElement('travelType');
        $travelType->appendChild(
                $doc->createTextNode($this->travelType)
        );
        $travelDescription->appendChild($travelType);

        $originLocation = $doc->createElement('originLocation');
        $originLocation->appendChild(
                $doc->createTextNode($this->originLocation)
        );
        $travelDescription->appendChild($originLocation);

        foreach ($this->destLocation as $dest) {
            $destinationLocation = $doc->createElement('destinationLocation');
            $destinationLocation->appendChild(
                    $doc->createTextNode($dest)
            );
            $travelDescription->appendChild($destinationLocation);
        }

        //travellers
        $travellers = $doc->createElement('travellers');
        $requestPricing->appendChild($travellers);

        //child
        $child = $doc->createElement('item');
        $child->setAttribute('class', 'child');
        $childNumber = $doc->createElement('number');
        $childNumber->appendChild(
                $doc->createTextNode($this->numChild)
        );
        $child->appendChild($childNumber);
        $travellers->appendChild($child);

        //adult
        $adult = $doc->createElement('item');
        $adult->setAttribute('class', 'adult');
        $adultNumber = $doc->createElement('number');
        $adultNumber->appendChild(
                $doc->createTextNode($this->numAdult)
        );
        $adult->appendChild($adultNumber);
        $travellers->appendChild($adult);

        //senior
        $senior = $doc->createElement('item');
        $senior->setAttribute('class', 'senior');
        $seniorNumber = $doc->createElement('number');
        $seniorNumber->appendChild(
                $doc->createTextNode($this->numSenior)
        );
        $senior->appendChild($seniorNumber);
        $travellers->appendChild($senior);

        //senior1
        $senior1 = $doc->createElement('item');
        $senior1->setAttribute('class', 'senior1');
        $senior1Number = $doc->createElement('number');
        $senior1Number->appendChild(
                $doc->createTextNode($this->numSenior1)
        );
        $senior1->appendChild($senior1Number);
        $travellers->appendChild($senior1);

        //senior2
        $senior2 = $doc->createElement('item');
        $senior2->setAttribute('class', 'senior2');
        $senior2Number = $doc->createElement('number');
        $senior2Number->appendChild(
                $doc->createTextNode($this->numSenior2)
        );
        $senior2->appendChild($senior2Number);
        $travellers->appendChild($senior2);

        //senior3
        $senior3 = $doc->createElement('item');
        $senior3->setAttribute('class', 'senior3');
        $senior3Number = $doc->createElement('number');
        $senior3Number->appendChild(
                $doc->createTextNode($this->numSenior3)
        );
        $senior3->appendChild($senior3Number);
        $travellers->appendChild($senior3);

        $this->xmlPostFildes = $doc->saveXML();
        return $doc->saveXML();
    }

}
