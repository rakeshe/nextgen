<?php
/**
 *
 * @package    WidgetController.php
 * @author     K N Santosh Hegde
 * @since      8/4/15 1:44 PM
 * @version    1.0
 */

namespace HC\Api\Controllers;

use Phalcon\Http\Client\Exception,
    Phalcon\Http\Client\Request,
    Phalcon\Http\Response,
    Phalcon\Validation\Message,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email;


class WidgetController extends ControllerBase {

    const DEFAULT_THEME = 'default';

    const DEFAULT_THEME_DEVICE = 'desktop';

    const DEFAULT_LOCALE = 'en_AU';

    const DEFAULT_SCOPE = 'full';

    private $languageCode;

    private $scope;

    private $device;

    private $theme;

    private $responseContentType = 'text/html';

    private $name_seo;

    public function initialize() {

        $this->setParams();
    }

    /**
     *  Validate required params and set to class properties
     */

    public function setParams() {

        //set id
        $this->name_seo = $this->request->getQuery('id');

        //validate and set scopt (full or partial)
        $this->scope = (null != $this->request->getQuery('scope')) ?
            in_array($this->request->getQuery('scope'), (array) $this->config->scope) ? $this->request->getQuery('scope')
                : self::DEFAULT_SCOPE : self::DEFAULT_SCOPE;

        // validate and set language
        $this->languageCode = (null != $this->request->getQuery('locale')) ?
            in_array($this->request->getQuery('locale'), (array) $this->config->locales) ? $this->request->getQuery('locale')
                : self::DEFAULT_LOCALE : self::DEFAULT_LOCALE;

        //set theme name
        $this->theme = (null != $this->request->getQuery('theme')) ?  array_key_exists($this->request->getQuery('theme'), $this->config->themes->carousel)
            ? $this->request->getQuery('theme') :  self::DEFAULT_THEME : self::DEFAULT_THEME;

        //set device type
        $this->device = (null != $this->request->getQuery('device')) ? array_key_exists($this->request->getQuery('device'), (array) $this->config->themeMode)
            ? $this->request->getQuery('device') : self::DEFAULT_THEME_DEVICE : self::DEFAULT_THEME_DEVICE;
    }

    /**
     * Carousel action
     */
    public function bannerAction() {

        //load carousel data
       $carouselData = $this->loadCarouselData();

        //enable view
        $this->enableView();

        $this->view->setVars([
            'protocal' => stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://',
            'serverName' => $_SERVER['SERVER_NAME'],
            'appVersion'=> APPLICATION_VERSION,
            'theme'     => 'api-carousel/' . $this->theme,
            'device'    => $this->device,
            'scope'     => $this->scope,
            'name_seo'  => $this->name_seo,
            'data'      => json_decode($carouselData, TRUE),
        ]);

        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render('banner/' . $this->theme . '/' . $this->device, 'body');
        $view->finish();
        $this->sendOutput('201 OK', $view->getContent());
    }


    /**
     * Send output to client
     *
     * @param $httpCode
     * @param bool $content
     */
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

    /**
     * Load carousel couch document
     * @return bool|string
     */

    public function loadCarouselData() {

        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get(ORBITZ_ENV . ":carousel:". md5($this->name_seo) . ":" . $this->languageCode);
            //$this->carouselData = json_decode($var, true);
            //return $this;

            return '{
               "id_banner":1,
               "name":"The Club",
               "name_seo":"the-club",
               "dt_created":"2015-04-07 14:44:23",
               "locale":"en_AU",
               "banners":[
                  {
                     "h1":"I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture. (1)",
                     "h2":null,
                     "h3":"Phillip, Sydney",
                     "h4":null,
                     "h5":null,
                     "h6":null,
                     "description":null,
                     "image_name" : "China",
                     "url_desktop":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_tablet":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_mobile":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "tags":null
                  },
                  {
                     "h1":"I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture. (1)",
                     "h2":null,
                     "h3":"Phillip, Sydney",
                     "h4":null,
                     "h5":null,
                     "h6":null,
                     "description":null,
                     "image_name" : "China",
                     "url_desktop":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_tablet":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_mobile":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "tags":null
                  },
                  {
                     "h1":"I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture. (1)",
                     "h2":null,
                     "h3":"Phillip, Sydney",
                     "h4":null,
                     "h5":null,
                     "h6":null,
                     "description":null,
                     "image_name" : "China",
                     "url_desktop":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_tablet":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_mobile":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "tags":null
                  },
                  {
                     "h1":"I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture. (1)",
                     "h2":null,
                     "h3":"Phillip, Sydney",
                     "h4":null,
                     "h5":null,
                     "h6":null,
                     "description":null,
                     "image_name" : "China",
                     "url_desktop":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_tablet":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_mobile":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "tags":null
                  },
                  {
                     "h1":"I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture. (1)",
                     "h2":null,
                     "h3":"Phillip, Sydney",
                     "h4":null,
                     "h5":null,
                     "h6":null,
                     "description":null,
                     "image_name" : "China",
                     "url_desktop":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_tablet":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "url_mobile":"http://dev.nextgen.com/n/themes/api-banner/default/img/banner.png",
                     "tags":null
                  }
               ]
            }';

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * Enable view
     */
    private function enableView() {

        $di = $this->getDI();
        $di['view']->enable();
    }

}