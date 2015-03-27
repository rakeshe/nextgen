<?php
/**
 *
 * @package    UIController.php
 * @author     Santosh Hegde
 * @since      27/03/15
 * @version    1.0
 */

namespace HC\Api\Controllers;

use Phalcon\Http\Client\Exception,
    Phalcon\Http\Client\Request,
    Phalcon\Http\Response,
    Phalcon\Validation\Message,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email;

class UIController extends ControllerBase {

    const DEFAULT_THEME = 'merch';

    const DEFAULT_THEME_MODE = 'desktop';

    const DEFAULT_LOCALE = 'en_AU';

    const DEFAULT_CURRENCY_CODE = 'USD';

    private $menu;

    private $langData;

    private $translation;

    private $languageCode;

    private $currencyCode;

    private $themeMode;

    private $theme;

    private $responseContentType = 'text/html';

    public function initialize() {

        // load view is not working, need to figure out...
        //$this->enableView();

        $this->setParams();

        $this->loadCouchMenu();

        $this->loadCouchLanguage();

        $this->translation = new \HC\Library\Translation ( $this->languageCode, $this->langData );

    }

    public function setParams() {


        $this->languageCode = (null != $this->request->getQuery('locale')) ?
            in_array($this->request->getQuery('locale'), (array) $this->config->locales) ? $this->request->getQuery('locale')
                : self::DEFAULT_LOCALE : self::DEFAULT_LOCALE;

        $this->currencyCode = self::DEFAULT_CURRENCY_CODE;

        $this->theme = (null != $this->request->getQuery('theme')) ?  array_key_exists($this->request->getQuery('theme'), $this->config->themes)
            ? $this->request->getQuery('theme') :  self::DEFAULT_THEME : self::DEFAULT_THEME;

        $this->themeMode = (null != $this->request->getQuery('mode')) ? array_key_exists($this->request->getQuery('mode'), $this->config->themeMode)
            ? $this->request->getQuery('mode') : self::DEFAULT_THEME_MODE : self::DEFAULT_THEME_MODE;

    }

    public function headerAction() {

        $this->view->setVars([
            'appVersion'        => APPLICATION_VERSION,
            'theme'             => 'api-ui/' . $this->theme,
            'menuItemsTop'      => $this->menu->top,
            'menuItemsSite'     => $this->menu->site,
            'menuItemsLanguageOptions' => ( array ) $this->menu->languageOptions,
            'menuItemsRightSite'=> $this->menu->rightSite,
            'menuItemsAccount'  => $this->menu->account,
            "t"                 => $this->translation->getTranslation (),
            'currencies'        => $this->config->currencies->toArray(),
            'currencyList'      => $this->getCurrencyListByGroup(),
            'languageCode'      => $this->languageCode,
            'currencyCode'      => $this->currencyCode,
        ]);

        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render($this->theme . '/' . $this->themeMode, 'header');
        $view->finish();
        $this->sendOutput('201 OK', $view->getContent());

    }

    public function footerAction() {

        $this->view->setVars([
            'appVersion' => APPLICATION_VERSION,
            'theme'      => 'api-ui/' . $this->theme,
        ]);

        $view = clone $this->view;
        $view->start();
        $view->setRenderLevel($view::LEVEL_ACTION_VIEW);
        $view->render($this->theme . '/' . $this->themeMode, 'footer');
        $view->finish();
        $this->sendOutput('201 OK', $view->getContent());
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

    protected function getCurrencyListByGroup() {

        $currencyGroup = $this->config->currencyGroup->toArray();
        $currencies = $this->config->currencies->toArray();
        foreach($currencyGroup as $index => $group){
            foreach($group as $currencyCategory ){
                $currencyList[$index][ucfirst(str_replace('-',' ',$currencyCategory))] = $currencies[$currencyCategory];
            }
        }
        return $currencyList;
    }

    public function getTranslation() {
        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $this->messages
        ));
    }

    public function loadCouchMenu() {
        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get("merch:menu:" . md5('site-menu'));
            $var = empty($var) ? '' : $var;
            $this->menu = json_decode($var);
            return $this;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function loadCouchLanguage() {

        try {
            $Couch = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $var   = $Couch->get(ORBITZ_ENV . ":merch:lang:" . md5('lang-' . $this->languageCode) . ":" . $this->languageCode);
            $this->langData = json_decode($var, true);
            return $this;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    private function enableView() {

        $di = $this->getDI();

        $di['view'] = function($di) use($di) {

            $view = $di['view'];

            $view->setViewsDir(__DIR__.'/views/themes/');

            $view->registerEngines(array(
                '.volt' => function($view, $di) {

                    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => __DIR__.'/../../data/volt/',
                        'compiledSeparator' => '_',
                    ));
                    //This binds the function php function to volt function
                    $compiler = $volt->getCompiler();
                    $compiler->addFunction('ucfirst', 'ucfirst');
                    $compiler->addFunction('print_r', 'print_r');
                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php' // Generate Template files uses PHP itself as the template engine
            ));

            return $view;
        };

        $this->setDI( $di );
    }

} 