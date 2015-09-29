<?php

namespace HC\HCFA\Controllers;

use HC\HCFA\Models\MailChimpMember;

/**
 *
 * @package    RegisterController.php
 * @author     K.N. Santosh Hegde
 * @since      24/09/2015
 * @version    1.0
 */

class RegisterController extends ControllerBase {

    private $errorMessage = [];
    const DEFAULT_ERROR_MESSAGE = 'Error. Agent ID and email address do not match. Please try again.';
    const RESPONSE_MESSAGE_EMAIL_NOT_IN_LIST = 'The email address passed does not exist on this list';
    const ERROR_MESSAGE_EMAIL_NOT_IN_LIST = 'That email address does not exist on our file, please use the email address where you received this registration invite.';

    /** @var  MailChimpMember */
    protected $mailChimpMember;

    public function initialize() {

    }

    public function indexAction() {



        if ($this->request->isPost()) {

            $api = new \MCAPI($this->config->mailchimp->apikey);

            if ( !$api->errorCode ) {

                $this->mailChimpMember = new MailChimpMember();
                $return = $api->listMemberInfo($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'));
                $this->mailChimpMember->init($return);

                $postedEmail = $this->request->getPost('EMAIL');
                $postedUid = $this->request->getPost('TA_ID');

                if ( $this->mailChimpMember->isUpdateAllowed($postedEmail, $postedUid, 'TA_ID')) {
                    //update member info
                    $inputVars = [
                      'TA_NAME' => $this->request->getPost('TA_NAME'),
                      'FNAME' => $this->request->getPost('FNAME'),
                      'TA_ID' => $postedUid,
                      'EMAIL' => $postedEmail,
                      'PHONE' => $this->request->getPost('PHONE'),
                    ];

                    $data = $api->listUpdateMember($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'), $inputVars, 'html', false);
                    if ( $data == true ) {
                        //load success page
                    } else {
                        $this->errorMessage[] = self::DEFAULT_ERROR_MESSAGE;
                    }
                } else {
                    $errorMessage = !empty($return['data'][0]['error']) ? $return['data'][0]['error'] : self::DEFAULT_ERROR_MESSAGE;
                    $errorMessage = $errorMessage === self::RESPONSE_MESSAGE_EMAIL_NOT_IN_LIST ? self::ERROR_MESSAGE_EMAIL_NOT_IN_LIST : $errorMessage;
                    $this->errorMessage[] = $errorMessage;
                }

            }
        }


        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
            'msg'          => $this->errorMessage
        ]);
    }
}