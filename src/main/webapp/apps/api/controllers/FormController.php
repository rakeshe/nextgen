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

    private $validationMessages = [];


    public function initialize() {

        $this->updateWhiteListFile();

        //validate security stuffs
        $this->validate();
    }

    private function validate() {

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

        //verify hash
        if (false == $this->verifyHash()) {
            $this->responseContentType = 'application/json';
            $this->sendOutput('201 OK', json_encode([
                'message' => [
                    'value' => 'Token is invalid',
                    'errorCode' => 'INVALID_TOKEN'
                ]
            ]));
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


    private function validateInputData() {

        $validator = new \Phalcon\Validation();

        if (isset($this->validations[$this->request->getQuery('api_key')])) {

            foreach ($this->validations[$this->request->getQuery('api_key')] as $key => $val ) {

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
            $formModel->id_app = $this->request->getQuery('api_key', 'striptags');

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
            $formModel->id_app = $this->request->getQuery('api_key', 'striptags');

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
}
