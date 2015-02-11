<?php

/**
 * @author     K.N. Santosh Hegde
 * @package    Mix and Match
 * @since      09/02/2015
 * @version    1.0
 */
namespace HC\MixAndMatch\Controllers;
use \Phalcon\Mvc\Controller;

class IndexController extends Controller {

    const THEME_PATH = "themes/mixandmatch/";
    const TEMPLATE_SERVER_PATH = "http://exauric.com.au/hc_menulog/";
    const EMAIL_TEMPLATE_DIR = "email-templates";

    private $email;
    private $place;
    private $food;
    private $ans;
    private $fName;
    private $lName;
    private $suburb;
    private $state;

    public function initialize() {

        if ($this->request->isAjax() && $this->request->getPost('isMail') == 'true') {
            $this->setInputVars();
            $this->sendMessage();
            $this->view->disable();
            $this->response->setHeader("Content-Type", "x-www-form-urlencoded");
            die();
        }
    }
    
    /**
     * Loading first time
     */
    public function init() {
        \Phalcon\Tag::setTitle(
            $this->di->get('config')['site']['title']
        );
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

        // load classes
        $this->init(); 
        //set variable for view
        $this->view->setVars(array(
            'appVersion' => APPLICATION_VERSION,
            'theme'      => self::THEME_PATH
        ));
    }

    public function getTemplate($name, $params) {

        $this->view->setVars($params);
        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render(self::EMAIL_TEMPLATE_DIR, $name);
        $view->finish();
        return $view->getContent();
    }

    private function setInputVars() {

        $this->email  = $this->request->getPost('hidden-email', 'email');
        $this->place  = $this->request->getPost('hidden-selected-place', 'string');
        $this->food   = $this->request->getPost('hidden-selected-food', 'string');
        $this->ans    = $this->request->getPost('answer', 'striptags');
        $this->fName  = $this->request->getPost('first_name', 'string');
        $this->lName  = $this->request->getPost('last_name', 'string');
        $this->suburb = $this->request->getPost('suburb', 'string');
        $this->state  = $this->request->getPost('state', 'string');
    }

    public function sendMessage() {

        if ($this->email === null)
            return;


        //get user mail body
       $userMailBody = $this->getTemplate('offer', [
            'serverPath' => self::TEMPLATE_SERVER_PATH,
            'firstName'  => $this->fName
        ]);

        // send mail to user
        $this->mail(
            //to
            [
                $this->email => $this->fName .' ' . $this->lName
            ],
            //from
            [
                $this->di->get('config')['mail']['admin']['email'] => $this->di->get('config')['mail']['admin']['name']
            ],
            //subject
            $this->di->get('config')['mail']['admin']['subject'],
            //body
            $userMailBody
        );

        //get admin body
        $adminBody = $this->getTemplate('admin', [
            'subject'   => $this->di->get('config')['mail']['admin']['subject'],
            'email'     => $this->email,
            'firstName' => $this->fName,
            'lastName'  => $this->lName,
            'answer'    => $this->ans,
            'state'     => $this->state,
            'suburb'    => $this->suburb,
            'place'     => $this->place,
            'food'      => $this->food,
            'userIP'    => $this->request->getClientAddress()
        ]);

        //mail to admin
        $this->mail(
            //to
            [
                $this->di->get('config')['mail']['admin']['email'] => $this->di->get('config')['mail']['admin']['name']
            ],
            //from
            [
                $this->email => $this->fName .' ' . $this->lName
            ],
            //subject
            $this->di->get('config')['mail']['admin']['subject'],
            //body
            $adminBody
          );
        return;
    }

    /**
     * @param $to array
     * @param $from array
     * @param $subject string
     * @param $body text/html
     * @param string sting
     * @return bool
     */
    private function mail($to, $from, $subject, $body, $bodyType = 'text/html') {

        $transport = \Swift_MailTransport::newInstance();
        // Create the message
        $message = \Swift_Message::newInstance();
        $message->setTo($to);
        //set the subject
        $message->setSubject($subject);
        //set body
        $message->setBody($body, $bodyType);
        //set from address with name
        $message->setFrom($from);
        // Send the email
        $mailer = \Swift_Mailer::newInstance($transport);
        return $mailer->send($message);
    }

}
