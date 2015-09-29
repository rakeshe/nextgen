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

    const THEME_NAME = 'default';

    /** @var  MailChimpMember */
    protected $mailChimpMember;

    /** @var  HCFAModel */
    protected $hcfaModel;

    /** @var  page text */
    private $cmsContent;

    /** @var  app config */
    private $appConfig;


    public function initialize() {

        $this->hcfaModel = new \HC\HCFA\Models\HCFAModel();

        $this->setUpData();
    }

    public function setUpData() {

        $this->cmsContent = $this->hcfaModel->getDocument( \HC\HCFA\Models\HCFAModel::DOC_NAME_CMS );

        $configData = $this->hcfaModel->getDocument( \HC\HCFA\Models\HCFAModel::DOC_NAME_CONFIG, true );

        $localConfig = $this->config->mailchimp;

        //update local config with couch document
        if (isset($configData['mailchimp'])) {

            foreach ($configData['mailchimp'] as $key => $value) {
                $localConfig[$key] = $value;
            }
        }

        $this->appConfig = $localConfig;
    }

    public function indexAction() {

        if ($this->request->isPost()) {

            $api = new \MCAPI($this->config->mailchimp->apikey);

            if ( !$api->errorCode ) {

                $this->mailChimpMember = new MailChimpMember();
                $return = $api->listMemberInfo($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'));

                if ($return) {

                    $this->mailChimpMember->init($return);


                    $postedEmail = $this->request->getPost('EMAIL');
                    $postedUid = $this->request->getPost('TA_ID');

                    if ($this->mailChimpMember->isUpdateAllowed($postedEmail, $postedUid, 'TA_ID')) {
                        //update member info
                        $inputVars = [
                            'TA_NAME' => $this->request->getPost('TA_NAME'),
                            'FNAME' => $this->request->getPost('FNAME'),
                            'TA_ID' => $postedUid,
                            'EMAIL' => $postedEmail,
                            'PHONE' => $this->request->getPost('PHONE'),
                        ];

                        $data = $api->listUpdateMember($this->config->mailchimp->listId, $this->request->getPost('EMAIL', 'email'), $inputVars, 'html', false);

                        if ($data == true) {
                            //load success page
                            //there is no campaign is exists
                            $this->dispatcher->forward([
                                'controller' => 'register',
                                'action' => 'success',
                            ]);
                        } else {
                            $this->errorMessage[] = $this->mailChimpMember->getParsedErrorMessage();
                        }
                    } else {
                        $this->errorMessage[] = $this->mailChimpMember->getParsedErrorMessage();
                    }

                }
            } else {
                $this->errorMessage[] = $this->mailChimpMember->getParsedErrorMessage();
            }
        }


        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
            'msg'          => $this->errorMessage,
            'cms'          => json_decode( $this->cmsContent, true ),
            'theme'        => self::THEME_NAME
        ]);

        $this->view->pick( self::THEME_NAME . '/index/index');
    }

    public function successAction() {

        $this->view->setVars([
            'appVersion'   => APPLICATION_VERSION,
            'msg'          => $this->errorMessage,
            'cms'          => json_decode( $this->cmsContent, true ),
            'theme'        => self::THEME_NAME
        ]);

        $this->view->pick( self::THEME_NAME . '/index/success');
    }
}