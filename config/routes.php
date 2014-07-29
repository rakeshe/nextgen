<?php

$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);

    define('MODULE_NAME' ,'/([a-z\-]+)');
    define('RE_SEOPATH_ALPHANUM' ,'/([a-zA-Z0-9\-]+)');
    define('RE_SEOPATH_ALPHA' ,'/([a-zA-Z\-]+)');
    define('RE_LANGUAGE_CODE','/([a-z]{2})');
    define('DEFAULT_ROUTE_CONTROLLER', 'index');
    define('DEFAULT_ROUTE_ACTION','page');

        /**
         * Set language route
         */
        $router->add(
            "/set-language/{language:[a-z]+}",
            array(
                'controller' => 'index',
                'action'     => 'setLanguage',
                'module' => 'nextgen',
                'namespace' => 'HC\Nextgen\Controllers\\',
            )
        );


        /**
         * Language based Campaign landing pages
         * matches: /en/Merch-campaign-name-01/params
         */
        $router->add(
             MODULE_NAME . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . '/:params',
            array(
                "languageCode"  => 2,
                "campaignName"  => 3,
                "params"        => 4,
                "controller"    => 'index',
                "action"        => 'page',
                'module'        => 'nextgen',
                'namespace'     => 'HC\Nextgen\Controllers\\',
            )
        );
       




$router->add('', array(
	'module' => 'ti',
	'namespace' => 'HC\TI\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/', array(
	'module' => 'ti',
	'namespace' => 'HC\TI\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/index', array(
	'module' => 'ti',
	'namespace' => 'HC\TI\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/travel-insurance', array(
	'module' => 'ti',
	'namespace' => 'HC\TI\Controllers\\',
	'controller' => 'index',
	'action' => 'index',
         "params"       => 4,
));

//Set 404 paths
$router->notFound(array(
    'module' => 'nextgen',
    'namespace' => 'HC\Nextgen\Controllers\\',
    'controller' => 'Error',
    'action' => 'show404',
));


return $router;
