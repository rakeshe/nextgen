<?php

namespace HC\HCFA\Controllers;

/**
 *
 * @package    RegisterController.php
 * @author     K.N. Santosh Hegde
 * @since      24/09/2015
 * @version    1.0
 */

class RegisterController extends ControllerBase {

    private $errorMessage = [];

    public function initialize() {

    }

    public function indexAction() {



        if ($this->request->isPost()) {

            $api = new \MCAPI($this->config->mailchimp->apikey);

            if ( !$api->errorCode ) {

                $return = $api->listMemberInfo($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'));

                if ( $return['success'] == 1 && $return['errors'] == 0) {
                    //update member info
                    $inputVars = [
                      'TA_NAME' => $this->request->getPost('TA_NAME'),
                      'FNAME' => $this->request->getPost('FNAME'),
                      'TA_ID' => $this->request->getPost('TA_ID'),
                      'EMAIL' => $this->request->getPost('EMAIL'),
                      'PHONE' => $this->request->getPost('PHONE'),
                    ];
                    $data = $api->listUpdateMember($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'), $inputVars, 'html', false);
                    if ( $data == true ) {
                        //load success page
                    } else {
                        $this->errorMessage[] = 'There is some technical problem, please thy again!!';
                    }
                } else {
                    $this->errorMessage[] = 'There is some technical problem, please thy again!!';
                }

            }
        }


        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
            'msg'          => $this->errorMessage
        ]);
    }

}