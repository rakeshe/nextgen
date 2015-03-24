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
    const WHITE_LIST_URL_FILE = 'formWhiteListUrls.json';

    // the doc generate format:-> api:form: md5('white_list_urls'):doc;
    const WHITE_LIST_DOCUMENT_FILE = 'api:form:aae72e94ee51b1151bf9ad47823402f0:doc';

    private $whiteListUrls;

    private $whiteListType;

    private $isWhiteListed = false;

    private $responseContentType = 'application/json';

    private $validationMessages = [];

    private $availableHosts = [];

    public function initialize() {

        //validate security stuffs
        $this->validate();
    }

    private function validate() {


        $this->updateWhiteListFile();

        //load whitelist file
        $this->loadWhiteListUrls();

        //verify api key
        if (false == $this->verifyAppKey()) {
            $this->responseContentType = 'text/html';
            $this->sendOutput('401 Unauthorized');
        }

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

        if (true == $this->request->isPost() && true == $this->request->isAjax()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * load whitelist url file
     */

    private function loadWhiteListUrls() {

        try{

            if (file_exists(__DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE)) {
                //require_once __DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE;
                $this->whiteListUrls = json_decode(file_get_contents(__DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE), true);
            } else {
                throw new Exception('required file does not exists');
            }

        }catch (\Exception $e) {
            $this->getExceptionMessage($e);
        }
    }

    /**
     * To verify app key
     * @return bool
     */
    private function verifyAppKey() {

        if (null!= $this->request->getPost('api_key') &&
            array_key_exists($this->request->getPost('api_key'), $this->whiteListUrls)) {

            $this->availableHosts = $this->whiteListUrls[$this->request->getPost('api_key')];
            return true;
        }
        return false;
    }

    /**
     * Verify host name or IP is whitelisted or not
     * @return bool
     */
    private function verifyHost() {

        if (null !== $this->request->getHttpHost() && null !== $this->availableHosts &&
            array_key_exists($this->request->getHttpHost(), $this->availableHosts)) {
            $this->whiteListType = 'HOST';
            $this->isWhiteListed = true;
            return true;
        } else if (null !== $this->request->getHttpHost() && null !== $this->availableHosts &&
            array_key_exists($this->request->getClientAddress(), $this->availableHosts)) {
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
            'message' => 'The first name is required',
        ]));

        $validation->add('last_name', new PresenceOf([
            'message' => 'The last name is required'
        ]));

        $validation->add('comments', new PresenceOf([
            'message' => 'The comment field is required'
        ]));


        $message = $validation->validate($this->request->getPost());

        if (count($message) > 0) {

            foreach ($message as $key => $msg) {

              array_push($this->validationMessages , ['code' => $this->getErrorCodes()[$msg->getField()]['code'],
                  'message' => $msg->getMessage()]);
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

            $now   = new \DateTime('now');
            $formModel->timestamp =  $now->format( 'Y-m-d h:m:s' );
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

    protected function updateWhiteListFile(){

        $filePath = __DIR__ . '/../config/' . self::WHITE_LIST_URL_FILE;

        $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];

        $cacheData   = $Couch->get(self::WHITE_LIST_DOCUMENT_FILE);

        if (null != $cacheData) {

            $storeFile = true;

            if(file_exists($filePath) ){
                $interval = strtotime('-24 hours');
                if (filemtime($filePath) <= $interval ){
                    $storeFile = true;
                } else{
                    $storeFile = false;
                }
            }
            $request = new \Phalcon\Http\Request();
            $forceWrite = $request->getQuery('api-frm-whitelist-cache');
            if($forceWrite == 'yes') {
                $storeFile = true;
            }
            if($storeFile){
                $file = fopen($filePath, 'w');
                fputs($file, $cacheData);
                fclose($file);
            }
        }
    }

    public function getErrorCodes() {
        return [
            'api_key' => [
                'code' => 'INVALID_API_KEY',
                'message' => 'invalid api key'
            ],
            'title' => [
                'code' => 'INVALID_TITLE_FIELD',
                'message' => ''
            ],
            'first_name' => [
                'code' => 'INVALID_FIRST_NAME_FIELD',
                'message' => 'First name is required'
            ],
            'last_name' => [
                'code' => 'INVALID_LAST_NAME_FIELD',
                'message' => 'Last name is required'
            ],
            'email' => [
                'code' => 'INVALID_EMAIL_FIELD',
                'message' => ''
            ],
            'phone' => [
                'code' => 'INVALID_PHONE_FIELD',
                'message' => ''
            ],
            'city' => [
                'code' => 'INVALID_CITY_FIELD',
                'message' => ''
            ],
            'country' => [
                'code' => 'INVALID_COUNTRY_FIELD',
                'message' => ''
            ],
            'postcode' => [
                'code' => 'INVALID_POST_CODE_FIELD',
                'message' => ''
            ],
            'comments' => [
                'code' => 'INVALID_COMMENT_FIELD',
                'message' => ''
            ],
        ];
    }
}
