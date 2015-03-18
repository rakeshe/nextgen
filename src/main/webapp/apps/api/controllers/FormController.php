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
    }

    /**
     * Verify request type
     * @return bool
     */
    private function verifyRequestType() {

        if (true == $this->request->isPost() && true == $this->request->isAjax()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * load whitelist url file
     */

    public function loadWhiteListUrls() {

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

    public function storeAction() {

        if (true == $this->validateInputData()) {

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
