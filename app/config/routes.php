<?php
/**
 *
 * @package    routes.php
 * @author     Rakesh Shrestha
 * @since      21/11/13 5:22 PM
 * @version    1.0
 */

class configRouter extends Phalcon\Mvc\Router
{

    const RE_SEOPATH_ALPHANUM = '/([a-zA-Z0-9\-]+)';
    const RE_SEOPATH_ALPHA = '/([a-zA-Z\-]+)';
    const RE_LANGUAGE_CODE = '/([a-z]{2})';
    const DEFAULT_ROUTE_CONTROLLER = 'index';
    const DEFAULT_ROUTE_ACTION = 'page';


    public function __construct()
    {
        $this->setupRoutes();
    }

    /**
     * Setup url routing
     */
    protected function setupRoutes()
    {

        $this->setDefaultController('index');
        $this->setDefaultAction('page');
        /**
         * Default catch all routes
         */
        $this->add('/(\w+)', [
                'controller' => self::DEFAULT_ROUTE_CONTROLLER,
                "action"       => self::DEFAULT_ROUTE_ACTION
            ]);

        /**
         * Default Module/Controller/Action/Params fallback
         *
         */
        $this->add(
            "/:controller/:action/:params",
            array(
                "controller" => 1,
                "action"     => 2,
                "params"     => 3,
            )
        );

        /**
         * Set language route
         */
        $this->add(
            "/set-language/{language:[a-z]+}",
            array(
                'controller' => 'index',
                'action'     => 'setLanguage'
            )
        );


        /**
         * Language based Campaign landing pages
         * matches: /en/Merch-campaign-name-01/params
         */
        $this->add(
            self::RE_LANGUAGE_CODE . self::RE_SEOPATH_ALPHANUM . '/:params',
            array(
                "language"     => 1,
                "campaignName" => 2,
                "params"       => 3,
                "controller"   => 'index',
                "action"       => 'page'
            )
        );
        /**
         * Language based Campaign region pages
         * matches: /en/Merch-campaign-name-01/main-tab/params
         */
        $this->add(
            self::RE_LANGUAGE_CODE . self::RE_SEOPATH_ALPHANUM . self::RE_SEOPATH_ALPHA . '/:params',
            array(
                "language"     => 1,
                "campaignName" => 2,
                "menuTabMain"  => 3,
                "params"       => 4,
                "controller"   => 'index',
                "action"       => 'page'
            )
        );
        /**
         * Language based Campaign sub region pages
         * matches: /en/Merch-campaign-name-01/main-tab/sub-tab/
         */
        $this->add(
            self::RE_LANGUAGE_CODE . self::RE_SEOPATH_ALPHANUM . self::RE_SEOPATH_ALPHA . self::RE_SEOPATH_ALPHA . '/:params',
            array(
                "language"     => 1,
                "campaignName" => 2,
                "menuTabMain"  => 3,
                "menuTabSub"   => 4,
                "params"       => 5,
                "controller"   => 'index',
                "action"       => 'page'
            )
        );

    }
}