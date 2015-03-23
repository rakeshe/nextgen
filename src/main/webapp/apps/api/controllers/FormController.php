<?php
/**
 *
 * @package    FormDataController.php
 * @author     Santosh Hegde
 * @since      18/3/15
 * @version    1.0
 */
namespace HC\Api\Controllers;

use Phalcon\Http\Client\Exception,
    Phalcon\Http\Client\Request,
    Phalcon\Http\Response,
    Phalcon\Validation\Message,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email;

class FormController extends ControllerBase
{
    const WHITE_LIST_URL_FILE = 'formDataWhiteListUrls.php';

    private $whiteListUrls;

    private $whiteListType;

    private $isWhiteListed = false;

    private $responseContentType = 'application/json';

    private $validationMessages = [];

    public function initialize() {

        //validate security stuffs
        $this->validate();
    }

    private function validate() {

        //load whitelist file
        $this->loadWhiteListUrls();

        //verify host
        if (false == $this->verifyHost()) {
            $this->responseContentType = 'text/html';
            $this->sendOutput('401 Unauthorized');
        }

        //verify request type
        if (false == $this->verifyRequestType()) {

            $this->responseContentType = 'application/json';
            $this->sendOutput('201 OK', json_encode([
                'message' => [
                    'value' => 'Request type is not valid',
                    'errorCode' => 'INVALID_REQUEST_TYPE'
                ]
            ]));
        }

        //connect to mysql
        $this->connectMysql();
    }

    /**
     * Verify request type
     * @return bool
     */
    private function verifyRequestType() {
        return $this->request->isPost() && true == $this->request->isAjax();
    }
    /**
     * load whitelist url file
     */

    private function loadWhiteListUrls() {

        try{

            if (file_exists(__DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE)) {
                $this->whiteListUrls = require_once __DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE;
            } else {
                throw new Exception('required file does not exists');
            }

        }catch (\Exception $e) {
            $this->getExceptionMessage($e);
        }
    }

    /**
     * Verify host name or IP is whitelisted or not
     * @return bool
     */
    private function verifyHost() {

        if (null !== $this->request->getHttpHost() && array_key_exists($this->request->getHttpHost(), $this->whiteListUrls)) {
            $this->whiteListType = 'HOST';
            $this->isWhiteListed = true;
            return true;
        } else if (null !== $this->request->getHttpHost() && array_key_exists($this->request->getClientAddress(), $this->whiteListUrls)) {
            $this->whiteListType = 'IP';
            $this->isWhiteListed = true;
            return true;
        }
        return false;
    }
    /**
     * Get exception info
     * @param object $e
     */
    private function getExceptionMessage($e) {

        if ('dev' === ORBITZ_ENV) {
            echo "Form API Exception line no: {$e->getLine()}, Message: {$e->getMessage()}";
        } else {
            $this->getDI()->getShared('logger')->log("Form API Exception line no: {$e->getLine()},
                    Message: {$e->getMessage()}");
        }

    }

    private function sendOutput($httpCode, $content = false) {

        $res = new Response;
        $res
            ->setHeader("Content-Type", "{$this->responseContentType}; charset=UTF-8")
            ->setRawHeader("HTTP/1.1 {$httpCode}")
            ->setStatusCode($httpCode,'')
            ->setContent($content)
            ->send();
        die();
    }

    private function validateInputData() {

        $validation = new \Phalcon\Validation();

        $validation->add('first_name', new PresenceOf([
            'messages' => 'The first name is required',
        ]));

        $validation->add('last_name', new PresenceOf([
            'messages' => 'The last name is required'
        ]));

        $validation->add('email', new PresenceOf([
            'messages' => 'The e-mail is required'
        ]));

        $validation->add('email', new Email([
            'messages' => 'The e-mail is not valid'
        ]));

        $message = $validation->validate($this->request->getPost());

        if (count($message) > 0) {

            foreach ($message as $key => $msg) {
              array_push($this->validationMessages , $msg->getMessage());
            }
            return false;
        }
        return true;
    }

    /**
     * build mysql connection
     */
    public function connectMysql() {

        $di = $this->getDI();
        $config = $this->config;
        $di['db']  = function () use ($config) {
            return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname,
                "options" => array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                )
            ));
        };
        $this->setDI( $di);
    }

    /**
     * store action, to save data in mysql
     */

    public function storeAction() {

        if (true == $this->validateInputData()) {

            $formModel = new \HC\Api\Models\ApiFormData();

            $formModel->campaign_key = $this->request->getPost('campaign_key', 'striptags');
            $formModel->first_name = $this->request->getPost('first_name', 'striptags');
            $formModel->last_name = $this->request->getPost('last_name', 'striptags');
            $formModel->email = $this->request->getPost('email', 'striptags');
            $formModel->city = $this->request->getPost('city', 'striptags');
            $formModel->state = $this->request->getPost('state', 'striptags');
            $formModel->country = $this->request->getPost('country', 'striptags');
            $formModel->phone = $this->request->getPost('phone', 'striptags');
            $formModel->opt_in = $this->request->getPost('opt_in', 'striptags');
            $formModel->answer = $this->request->getPost('answer', 'striptags');
            $formModel->timestamp = $this->request->getPost('timestamp', 'striptags');
            $formModel->app_id = $this->request->getPost('app_id', 'striptags');

            if (!$formModel->save()) {

                $value = [];
                foreach ($formModel->getMessages() as $key => $message) {
                    $value[$key]['value'] = $message->getMessage();
                }
                $message = [$value];
            } else {

                $message = [
                    'value' => 'data stored successfully',
                    'successCode' => 'SUCCESS'
                ];
            }
            //send out put
            $this->sendOutput('201 OK', json_encode([
                'message' => [
                    $message
                ]
            ]));

        } else {
            $value = [];
            foreach ($this->validationMessages as $key => $message) {
               $value[$key]['value'] = $message;
            }

            $this->sendOutput('201 OK', json_encode([
                'message' => [
                    $value
                ]
            ]));
        }
    }
}
