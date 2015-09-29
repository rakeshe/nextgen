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
                        $this->errorMessage[] = $this->mailChimpMember->getParsedErrorMessage();
                    }
                } else {
                    $this->errorMessage[] = $this->mailChimpMember->getParsedErrorMessage();
                }

            }
        }


        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
            'msg'          => $this->errorMessage
        ]);
    }
}