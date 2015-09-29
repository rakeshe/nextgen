<?php

/**
 *
 * @package    Register Form
 * @author     K.N. Santosh Hegde
 * @since      29/9/2015
 * @version    1.0
 */


namespace HC\HCFA\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{

    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = array())
    {

        //Agency name
        $tName = new Text("TA_NAME");
        $tName->setAttributes([
            'placeholder' => 'Travel agency name',
            'class' => 'u-full-width'
            ]);
        $tName->setFilters(array('striptags', 'string'));
        $tName->addValidators(array(
            new PresenceOf(array(
                'message' => 'Travel agency name is required'
            ))
        ));
        $this->add($tName);

        //Agent name
        $name = new Text("FNAME");
        $name->setAttributes([
            'placeholder' => 'Your name',
            'class' => 'u-full-width'
        ]);
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Your Name is required'
            ))
        ));
        $this->add($name);

        //Agent ID
        $tID = new Text("TA_ID");
        $tID->setAttributes([
            'placeholder' => 'Travel agent ID',
            'class' => 'u-full-width'
        ]);
        $tID->setFilters(array('striptags', 'alphanum'));
        $tID->addValidators(array(
            new PresenceOf(array(
                'message' => 'Travel agent ID is required'
            ))
        ));
        $this->add($tID);

        // Email
        $email = new Text('EMAIL');
        $email->setAttributes([
            'placeholder' => 'Your email',
            'class' => 'u-full-width'
        ]);
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'E-mail is required'
            )),
            new Email(array(
                'message' => 'E-mail is not valid'
            ))
        ));
        $this->add($email);

        //telephone
        $telephone = new Text("telephone");
        $telephone->setAttributes([
            'placeholder' => 'Your phone',
            'class' => 'u-full-width'
        ]);
        $telephone->setFilters(array('striptags', 'string'));
        $telephone->addValidators(array(
            new PresenceOf(array(
                'message' => 'Your phone is required'
            ))
        ));
        $this->add($telephone);
    }

}