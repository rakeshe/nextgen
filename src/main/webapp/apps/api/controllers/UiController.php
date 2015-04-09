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


    public function initialize() {

        $this->setParams();

        $this->loadCouchMenu();

        $this->loadCouchLanguage();

        $this->translation = new \HC\Library\Translation ( $this->languageCode, $this->langData );

    }

    /**
     *  Validate input values and set to class properties
     */

    public function setParams() {

        // validate and set language
        $this->languageCode = (null != $this->request->getQuery('locale')) ?
            in_array($this->request->getQuery('locale'), (array) $this->config->locales) ? $this->request->getQuery('locale')
                : self::DEFAULT_LOCALE : self::DEFAULT_LOCALE;

        //validate and set currency
        if (null == $this->request->getQuery('curr', 'string')) {

            $this->currencyCode = self::DEFAULT_CURRENCY_CODE;
        } else {
            $isValid = false;
            foreach($this->config->currencies as $key => $val) {
                foreach($val as $k => $v) {
                    if ($this->request->getQuery('curr') === $k)
                        $isValid = true;
                }
            }

            if ($isValid == true)
                $this->currencyCode = $this->request->getQuery('curr', 'string');
            else
                $this->currencyCode = self::DEFAULT_CURRENCY_CODE;
        }

        //set theme name
        $this->theme = (null != $this->request->getQuery('theme')) ?  array_key_exists($this->request->getQuery('theme'), $this->config->themes)
            ? $this->request->getQuery('theme') :  self::DEFAULT_THEME : self::DEFAULT_THEME;

        //set theme type
        $this->themeMode = (null != $this->request->getQuery('mode')) ? array_key_exists($this->request->getQuery('mode'), $this->config->themeMode)
            ? $this->request->getQuery('mode') : self::DEFAULT_THEME_MODE : self::DEFAULT_THEME_MODE;

    }

    public function headerAction() {

        //enable view
        $this->enableView();

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

        //enable view
        $this->enableView();

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

    /**
     * Enable view
     */

    private function enableView() {

        $di = $this->getDI();
        $di['view']->enable();
    }

} 