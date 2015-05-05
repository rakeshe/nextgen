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

    const DEFAULT_SHOW_NAV_ARROWS = '1';

    const DEFAULT_SHOW_NAV_DOTS = '1';


    private $locale;

    private $scope;

    private $device;

    private $theme;

    private $name_seo;
    private $navArrows;
    private $navDots;


    protected $widgetData;

    protected $widgetHeight;

    protected $widgetWidth;

    public function initialize() {

        //update white list urls
        $this->updateWhiteListFile();

        //load white list urls
        $this->loadWhiteListUrls();

        //set api key manually
        if (isset($this->whiteListUrls['widget_banner'])) {

            $this->availableHosts = $this->whiteListUrls['widget_banner'];
        }

        //verify host
        if (false == $this->verifyHost()) {

            $this->responseContentType = 'text/html';
//            $this->sendOutput('401 Unauthorized');
            $this->sendOutput(json_encode($this->getHostsInfo()));
        }

        //set params
        $this->setParams();
    }

    /**
     *  Validate required params and set to class properties
     */

    public function setParams() {

        //set id
        $this->name_seo = $this->request->getQuery('id');

        //validate and set scopt (full or partial)
        $this->scope = (null != $this->request->getQuery('scope')) &&
            in_array($this->request->getQuery('scope'), (array) $this->config->scope) ?
            $this->request->getQuery('scope') : self::DEFAULT_SCOPE;

        // validate and set language
        $this->locale = (null != $this->request->getQuery('locale')) &&
            in_array($this->request->getQuery('locale'), (array) $this->config->locales) ?
            $this->request->getQuery('locale') : self::DEFAULT_LOCALE;

        //set theme name
        $this->theme = (null != $this->request->getQuery('theme')) &&
            array_key_exists($this->request->getQuery('theme'), $this->config->themes->carousel) ?
            $this->request->getQuery('theme') :  self::DEFAULT_THEME;

        //set device type
        $this->device = (null != $this->request->getQuery('device')) &&
            array_key_exists($this->request->getQuery('device'), (array) $this->config->themeMode) ?
            $this->request->getQuery('device') : self::DEFAULT_THEME_DEVICE;


        // Set overrides
        $this->navArrows = null === $this->request->getQuery('nav_arrows') ? self::DEFAULT_SHOW_NAV_ARROWS : $this->request->getQuery('nav_arrows') ;
        $this->navDots = null === $this->request->getQuery('nav_dots') ? self::DEFAULT_SHOW_NAV_DOTS : $this->request->getQuery('nav_dots') ;
        $this->widgetHeight = $this->request->getQuery('height');
        $this->widgetWidth = $this->request->getQuery('width');
    }

    /**
     * Carousel action
     */
    public function carouselAction() {

        //load carousel data
        $this->loadCarouselData();

        //enable view
        $this->enableView();

        $this->view->setVars([
            'protocol' => stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://',
            'serverName' => $_SERVER['SERVER_NAME'],
            'appVersion'=> APPLICATION_VERSION,
            'theme'     => 'api-banner/' . $this->theme,
            'device'    => $this->device,
            'scope'     => $this->scope,
            'name_seo'  => $this->name_seo,
            'nav_arrows'  => $this->navArrows,
            'nav_dots'  => $this->navDots,
            'data'      => $this->widgetData,
            'locale' => $this->locale,
                'width' => null === $this->widgetWidth ? $this->widgetData['width'] : $this->widgetWidth,
                'height' => null === $this->widgetHeight ? $this->widgetData['height'] : $this->widgetHeight

        ]);

        $this->view->render('banner/' . $this->theme . '/' . $this->device, 'body');
/*        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render('banner/' . $this->theme . '/' . $this->device, 'body');
        $view->finish();
        $this->sendOutput('201 OK', $view->getContent());*/
    }


    /**
     * Load carousel couch document
     * @return bool|string
     */

    public function loadCarouselData() {

        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get(ORBITZ_ENV . ":deals:". md5("banner"));
            if(!empty($var)){
                $var = json_decode($var, true);
                if(!empty($var[$this->name_seo]) ){
                    $this->widgetData = $var[$this->name_seo];
                }
            }


        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Enable view
     */
    private function enableView() {

        $di = $this->getDI();
        $di['view']->enable();
    }

    protected function getHostsInfo(){
        return [
            'this server' => $this->request->getServerName(),
            'requesting server' => $this->request->getHttpHost(),
            'white lists' => $this->availableHosts
            ];
    }

    public function printHostInfoAction(){
        print_r($this->getHostsInfo());
    }
}