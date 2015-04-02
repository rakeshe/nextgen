<?php
/**
 *
 * @package    FormDataController.php
 * @author     Santosh Hegde
 * @since      18/3/15
 * @version    1.0
 * @todo create a form validation based on template, eg for simple competion entry form: your_name, your_email, your_answer
 *       and full form: first_name, last_name, email ....
 */
namespace HC\Api\Controllers;

use Phalcon\Http\Client\Exception,
    Phalcon\Http\Client\Request,
    Phalcon\Http\Response,
    Phalcon\Validation\Message,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\Regex as RegexValidator;

class FormController extends ControllerBase
{
    const WHITE_LIST_URL_FILE = 'formWhiteListUrls.json';

    // the doc generate format:-> api:form: md5('white_list_urls'):doc;
    const WHITE_LIST_DOCUMENT_FILE = 'api:form:aae72e94ee51b1151bf9ad47823402f0:doc';

    const DEFAULT_WHITE_LIST_HOSTS = 'www.hotelclub.com, www.hotelclub.cn';

    private $whiteListUrls;

    private $whiteListType;

    private $isWhiteListed = false;

    private $responseContentType = 'application/json';

    private $validationMessages = [];

    private $availableHosts = [];

    private $app_id;

    private $hostName;

    public function initialize() {

        //validate security stuffs
        $this->validate();
    }


    /**
     * Validate incoming request for following:
     * 1. request type is get and ajax
     * 2. requesting host is whitelisted
     * 3. app_key hash matches md5 of "secret salt/request host"
     */
    private function validate() {


        $this->updateWhiteListFile();

        //load whitelist file
        $this->loadWhiteListUrls();

/*        //verify request type
        if (false == $this->verifyRequestType()) {

            $this->responseContentType = 'application/json';
            $this->sendOutput('201 OK', json_encode([
                        'message' => [
                            'value' => 'Request type is not valid',
                            'errorCode' => 'INVALID_REQUEST_TYPE'
                        ]
                    ]));
        }*/

        //verify host - check if request host is white listed
        if (false == $this->verifyHost()) {
            $this->responseContentType = 'text/html';
            $this->sendOutput('401 Unauthorized');
        }

        //verify app key check app_key matches nd5 hash of secret/requestHost
        if (false == $this->verifyAppKey()) {
            $this->responseContentType = 'text/html';
            $this->sendOutput('401 Unauthorized');
        }

        //connect to mysql
        $this->connectMysql();
    }

    /**
     * Verify hash code
     */
    private function verifyHash() {

        if (isset(getallheaders()['Authorization']) && null != getallheaders()['Authorization']) {

            if (isset($this->availableHosts[$this->hostName])
                && getallheaders()['Authorization'] === $this->availableHosts[$this->hostName]) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verify request type
     * @return bool
     */
    private function verifyRequestType() {

        return $this->request->isGet() && true == $this->request->isAjax();
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
        $key = $this->request->getQuery('app_key');
        $md5 = $this->getHashForHost() ;
        return null!= $this->request->getQuery('app_key') && $this->getHashForHost() === $this->request->getQuery('app_key');
    }

    /**
     * Verify host name or IP is whitelisted against app id
     * @return bool
     */
    private function verifyHost() {
        // Pass if within default hotelclub hosts
        if(in_array($this->request->getHttpHost(),explode(',', self::DEFAULT_WHITE_LIST_HOSTS))) return true;

        // Check if request host is whitelisted againts app id
        $appId = $this->request->getQuery('app_id');
        if(!empty($this->whiteListUrls[$appId])){
            $this->availableHosts = $this->whiteListUrls[$appId];

            if (null !== $this->request->getHttpHost() && null !== $this->availableHosts &&
                array_key_exists($this->request->getHttpHost(), $this->availableHosts)) {
                $this->whiteListType = 'HOST';
                $this->isWhiteListed = true;
                $this->hostName = $this->request->getHttpHost();
                return true;
            } else if (null !== $this->request->getClientAddress() && null !== $this->availableHosts &&
                array_key_exists($this->request->getClientAddress(), $this->availableHosts)) {
                $this->whiteListType = 'IP';
                $this->isWhiteListed = true;
                $this->hostName = $this->request->getClientAddress();
                return true;
            }
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

        $validator = new \Phalcon\Validation();

        if (isset($this->validations[$this->request->getQuery('app_key')])) {

            foreach ($this->validations[$this->request->getQuery('app_key')] as $key => $val ) {

                if (isset($val['builtin']) && is_array($val['builtin'])) {

                    foreach ($val['builtin'] as $k => $v) {

                        /*
                         * KNOWN BUG - CAN'T CREATE OBJECT FROM VARIABLE
                         * Because of that using if and else statement
                         */

                        if ($k == 'PresenceOf') {

                            $validator->add($key, new PresenceOf([
                                'message' => $v
                            ]));

                        } else if ($k == 'Email') {

                            $validator->add($key, new Email([
                                'message' => $v
                            ]));

                        } else if ($k == 'something-else') {

                            $validator->add($key, new $k([
                                'message' => $v
                            ]));
                        }


                       /* $validator->add($key, new RegexValidator(array(
                            'pattern' => $k,
                            'message' => $v
                        )));*/
                    }
                }

            }

        }

/*        $validation = new \Phalcon\Validation();

        $validation->add('first_name', new PresenceOf([
            'message' => 'Your first name is required',
        ]));

        $validation->add('last_name', new PresenceOf([
            'message' => 'Your last name is required'
        ]));

        $validation->add('comments', new PresenceOf([
            'message' => 'Your comments are required'
        ]));

        // Filter any extra spaces
        $validation->setFilters('first_name', 'trim')->setFilters('last_name', 'trim');*/

        $all = $this->request->getQuery();
        //array_shift($all);
        $message = $validator->validate($all);

        if (count($message) > 0) {

            foreach ($message as $key => $msg) {

              array_push($this->validationMessages , ['code' => $this->getErrorCodes()[$msg->getField()]['code'],
                  'message' => $msg->getMessage()]);
            }
            return false;
        }
        return true;
    }

    private function validateCompetitionInputData() {

        $validation = new \Phalcon\Validation();

        $validation->add('first_name', new PresenceOf([
                    'message' => 'Your name is required',
                ]));

        $validation->add('email', new Email([
                    'message' => 'Valid email address is required'
                ]));

        $validation->add('comments', new PresenceOf([
                    'message' => 'Your answer is required'
                ]));

        // Filter any extra spaces
        $validation->setFilters('first_name', 'trim')->setFilters('email', 'trim');

        $message = $validation->validate($this->request->getQuery());

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

            $formModel = new \HC\Api\Models\ApiForm();

            $formModel->campaign_key = $this->request->getQuery('campaign_key', 'striptags');
            $formModel->first_name = $this->request->getQuery('first_name', 'striptags');
            $formModel->last_name = $this->request->getQuery('last_name', 'striptags');
            $formModel->email = $this->request->getQuery('email', 'striptags');
            $formModel->city = $this->request->getQuery('city', 'striptags');
            $formModel->state = $this->request->getQuery('state', 'striptags');
            $formModel->country = $this->request->getQuery('country', 'striptags');
            $formModel->phone = $this->request->getQuery('phone', 'striptags');
            $formModel->opt_in = $this->request->getQuery('opt_in', 'striptags');
            $formModel->answer = $this->request->getQuery('answer', 'striptags');

            $now   = new \DateTime('now');
            $formModel->timestamp =  $now->format( 'Y-m-d h:m:s' );
            $formModel->id_app = $this->request->getQuery('app_id', 'striptags');

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
            $this->sendOutput('201 OK', $this->request->getQuery('callback') .'('. json_encode([
                'message' => [
                    $message
                ]
            ]).')' );

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

    /**
     * store action, to save data in mysql
     */
    public function storeCompetitionAction() {

        if (true == $this->validateCompetitionInputData()) {

            $formModel = new \HC\Api\Models\ApiForm();

//            $formModel->campaign_key = $this->request->getQuery('campaign_key', 'striptags');
            $formModel->first_name = $this->request->getQuery('first_name', 'striptags');
            $formModel->last_name = $this->request->getQuery('last_name', 'striptags');
            $formModel->email = $this->request->getQuery('email', 'striptags');
            $formModel->city = $this->request->getQuery('city', 'striptags');
            $formModel->state = $this->request->getQuery('state', 'striptags');
            $formModel->country = $this->request->getQuery('country', 'striptags');
            $formModel->phone = $this->request->getQuery('phone', 'striptags');
            $formModel->opt_in = $this->request->getQuery('opt_in', 'striptags');
            $formModel->comments = $this->request->getQuery('comments', 'striptags');

            $now   = new \DateTime('now');
            $formModel->dt_created =  $now->format( 'Y-m-d h:m:s' );
            $formModel->id_app = $this->request->getQuery('app_id', 'striptags');

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
            $this->sendOutput('201 OK', $this->request->getQuery('callback') .'('. json_encode([
                        'message' => [
                            $message
                        ]
                    ]).')' );

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
            'answer' => [
                'code' => 'INVALID_ANSWER_FIELD',
                'message' => ''
            ],
        ];
    }

    private $validations = [
        'mixandmatch' => [
            'first_name' => [
                'pattern' => [
                    '/^[\s]*[\s]*$/' => 'First name should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The first name is required'
                ]
            ],
            'email' => [
                'pattern' => [
                    '/^[\s]*$/' => 'email should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The email is required',
                    'Email'      => 'The e-mail is not valid'
                ]
            ],
            'comments' => [
                'pattern' => [
                    '/^[\s]*$/' => 'Answer name should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The answer is required',
                ]
            ],
        ],
        'sands_macau' => [

            'first_name' => [
                'pattern' => [
                    '/^[\s]*[\s]*$/' => 'First name should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The first name is required'
                ]
            ],
            'email' => [
                'pattern' => [
                    '/^[\s]*$/' => 'email should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The email is required',
                    'Email'      => 'The e-mail is not valid'
                ]
            ],
            'answer' => [
                'pattern' => [
                    '/^[\s]*$/' => 'Answer name should not be empty',
                ],
                'builtin' => [
                    'PresenceOf' => 'The answer is required',
                ]
            ],
        ]
    ];

    /**
     * @return string
     */
    public function getHashForHost(){
        $requestHost = $this->request->getHttpHost();
        $secretSalt = $this->config->secretKey->salt;
        return md5($secretSalt.'/'.$requestHost);
    }
}
