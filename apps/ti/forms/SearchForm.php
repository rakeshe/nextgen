<?php
/**
 *
 * @package    Search Form
 * @author     K.N. Santosh Hegde
 * @since      30/4/2014
 * @version    1.0
 */
namespace HC\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select AS Select;
use Phalcon\Validation\Validator\PresenceOf;


class SearchForm extends Form {

    public function initialize() {
        $this->buildForm();
    }

    public function buildForm() {

        //Country of Residence
        $sConfig = new \HC\Components\SearchBox();
        
        $country = new Select(
                'ddlcountry', (array) $sConfig->getValueByKey('countryOfResidence'), array(
                'class' => 'dropdown-tog',
                'style' => 'min-width: 100px !important;'
                )
        );
        $country->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Country of Residence field is required'
                    ))
        ));
        $this->add($country);

        //Adult
        $adultData = [];
        foreach (explode(',', $sConfig->getValueByKey('adult')->value) as $key => $value) {
            $adultData[$value] = $value;
        }
        $adult = new Select('ddlAdult', $adultData, array('class' => 'dropdown-tog'));
        $adult->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Adult field is required'
                    ))
        ));
        $this->add($adult);

        //Dependants
        $depsData = [];
        foreach (explode(',', $sConfig->getValueByKey('dependants')->value) as $key => $value) {
            $depsData[$value] = $value;
        }
        $deps = new Select('ddlChild', $depsData, array('class' => 'dropdown-tog'));
        $deps->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Dependants field is required'
                    ))
        ));
        $this->add($deps);

        //Date of Birth
        $dob = new Text('Adob1', array(
            'class' => 'Adult_date form-control',
            'name'  => 'AdobOne[]',
			'readonly'=>'readonly',
            
        ));
		$dob1 = new Text('Adob2', array(
            'class' => 'Adult_date form-control',
            'name'  => 'AdobOne[]',
            
        ));
		$dob2 = new Text('Adob3', array(
            'class' => 'Adult_date form-control',
            'name'  => 'AdobOne[]',
            
        ));
  
		$dob3 = new Text('Adob4', array(
			'class' => 'Adult_date form-control',
			'name'  => 'AdobOne[]',
			
		));
	  
	    $dob4 = new Text('Adob5', array(
			'class' => 'Adult_date form-control',
			'name'  => 'AdobOne[]',
			
		));
  
  
        $this->add($dob);
		$this->add($dob1);
		$this->add($dob2);
		$this->add($dob3);
		$this->add($dob4);
		

        //Specify Dates
        $strDate = new Text('dStartDate', array(
            'class' => 'form-control datepicker',
			'readonly'=>'readonly',
            
        ));
        $strDate->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Start date field is required'
                    ))
        ));
        $this->add($strDate);

        //Specify Dates
        $endDate = new Text('dEndDate', array(
            'class' => 'form-control datepicker',
			'readonly'=>'readonly',
            
        ));
        $endDate->addValidators(array(
            new PresenceOf(array(
                'message' => 'The End date field is required'
                    ))
        ));
        $this->add($endDate);
        
        //Specify Dates
        $couponCode = new Text('couponCode', array(
            'class' => 'form-control',
            'value' => $this->request->get('promotionCode',array('alphanum', 'trim'))
        ));        
        $this->add($couponCode);
    }

	
	
	
    }

