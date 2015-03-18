<?php

/**
 *
 * @package    ApiModel
 * @author     K.N. Santosh Hegde
 * @since      18/03/15
 * @version    1.0
 */

namespace HC\Api\Models;
use Phalcon\Exception,
    Phalcon\Mvc\Model\Validator\Email as Email;

class ApiFormData extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $campaign_key;

    /**
     *
     * @var string
     */
    public $first_name;

    /**
     *
     * @var string
     */
    public $last_name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $city;

    /**
     *
     * @var string
     */
    public $state;

    /**
     *
     * @var string
     */
    public $country;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var integer
     */
    public $opt_in;

    /**
     *
     * @var string
     */
    public $answer;

    /**
     *
     * @var string
     */
    public $timestamp;

    /**
     *
     * @var integer
     */
    public $app_id;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'campaign_key' => 'campaign_key', 
            'first_name' => 'first_name', 
            'last_name' => 'last_name', 
            'email' => 'email', 
            'city' => 'city', 
            'state' => 'state', 
            'country' => 'country', 
            'phone' => 'phone', 
            'opt_in' => 'opt_in', 
            'answer' => 'answer', 
            'timestamp' => 'timestamp', 
            'app_id' => 'app_id'
        );
    }

}
