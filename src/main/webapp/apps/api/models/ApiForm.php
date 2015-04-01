<?php

namespace HC\Api\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class ApiForm extends \Phalcon\Mvc\Model
{

    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id_api_form")
     */
    public $id_api_form;

    /**
     *
     * @var string
     */
    public $title;

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
     * @var string
     */
    public $postcode;

    /**
     *
     * @var integer
     */
    public $opt_in;

    /**
     *
     * @var string
     */
    public $comments;

    /**
     *
     * @var string
     */
    public $timestamp;

    /**
     *
     * @var integer
     */
    public $id_app;

    /**
     * Validations and business logic
     */
    public function validation()
    {

       /* $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );*/
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
            'id_api_form' => 'id_api_form',
            'title' => 'title', 
            'first_name' => 'first_name', 
            'last_name' => 'last_name', 
            'email' => 'email', 
            'city' => 'city', 
            'state' => 'state', 
            'country' => 'country', 
            'phone' => 'phone', 
            'postcode' => 'postcode', 
            'opt_in' => 'opt_in', 
            'comments' => 'comments', 
            'dt_created' => 'dt_created',
            'id_app' => 'id_app'
        );
    }

}
