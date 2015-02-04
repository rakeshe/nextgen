<?php
/**
 * Phalcon router accepts the patters in LIFO (Last In First Out) ordeer (note: 'notFound' executes will last)
 * So, Default, frequently accessible urls patterns is defined in LIFO order
 */

$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);
define('MODULE_NAME', '/([a-z\-]+)');
define('RE_SEOPATH_ALPHANUM', '/([a-zA-Z0-9\-]+)');
define('RE_SEOPATH_ALPHA', '/([a-zA-Z\- ]+)');

//define('RE_SEOPATH_ALPHA', '/^[\\s\\d\\p{L}]+$/u');
define('RE_LANGUAGE_CODE', '/([a-zA-z\_]{2,5})');
define('RE_CURRENCY_CODE', '/([A-Z]{3})');

define('DEFAULT_ROUTE_MODULE', 'merch');
define('DEFAULT_ROUTE_NAMESPACE', 'HC\Merch\Controllers');
define('DEFAULT_ROUTE_LOCALE', 'en_AU');
define('DEFAULT_ROUTE_CONTROLLER', 'index');
define('DEFAULT_ROUTE_ACTION', 'index');

/**
 * Set 404 (page not found) route
 */
$router->notFound(
    array(
        'module'     => 'merch',
        'namespace'  => DEFAULT_ROUTE_NAMESPACE,
        'controller' => 'index',
        'action'     => 'show404',
    )
);

/**
 * Set language route
 */
$router->add(
    "/n/set-language" . RE_LANGUAGE_CODE,
    array(
        'controller' => DEFAULT_ROUTE_CONTROLLER,
        'action'     => 'setLanguage',
        'module'     => DEFAULT_ROUTE_MODULE,
        'namespace'  => 'HC\Merch\Controllers\\',
        'languageCode' => 1
    )
);

/**
 * get currency
 */
$router->add(
		'/n/set-currency' . RE_CURRENCY_CODE,
		array(
				"controller"   => 'index',
				"action"       => 'setCurrency',
				'module'       => 'merch',
				'namespace'    => 'HC\Merch\Controllers\\',
				'curr' 		   => 1
		)
);
/**
 * Hongkong Calendar : Backbone.js app
 * matches: /hong-kong-interactive-calendar
 */
$router->add(
    '/n/hong-kong-interactive-calendar',
    array(
        'module'     => 'hk-calendar',
        'namespace'  => 'HC\HkCalendar\Controllers\\',
        'controller' => 'index',
        'action'     => 'index',
        "params"     => 4,
    )
);

//**********************************************************//
//************ Travel Insurance Module Url Routes **********//
//**********************************************************//
/**
 * matches: /travel-insurance
 */
$router->add(
    '/n/travel-insurance',
    array(
        'module'     => 'ti',
        'namespace'  => 'HC\TI\Controllers\\',
        'controller' => 'index',
        'action'     => 'index',
        "params"     => 4,
    )
);

//**********************************************************//
//******************   get lang      ***************//
//**********************************************************//
/**
 * get location
 */
$router->add(
    '/n/merch/get-location/:params',
    array(       
        "controller"   => 'index',
        "action"       => 'getLocation',
        'module'       => 'merch',
        'namespace'    => 'HC\Merch\Controllers\\',
    )
);

//**********************************************************//
//****************** Merch Module Url Routes ***************//
//**********************************************************//
/**
 * matches: /merch/ja_JP/Summer-Escape/
 */
$router->add(
    '/n/merch' . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . '/:params',
    array(
        "languageCode" => 1,
        "campaignName" => 2,
        "params"       => 3,
        "controller"   => 'index',
        "action"       => 'index',
        'module'       => 'merch',
        'namespace'    => 'HC\Merch\Controllers\\',
    )
);

/**
 * matches: merch/ja_JP/Summer-Escape/Asia/
 */
$router->add(
    '/n/merch' . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . '/:params',
    array(
        'languageCode' => 1,
        'campaignName' => 2,
        'regionName'   => 3,
        'params'       => 4,
        'controller'   => 'index',
        'action'       => 'index',
        'module'       => 'merch',
        'namespace'    => 'HC\Merch\Controllers\\',
    )
);

/**
 * matches: merch/ja_JP/Summer-Escape/Asia/India/
 */
$router->add(
    '/n/merch' . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . RE_SEOPATH_ALPHA . '/:params',
    array(
        'languageCode' => 1,
        'campaignName' => 2,
        'regionName'   => 3,
        'countryName'  => 4,
        'params'       => 5,
        'controller'   => 'index',
        'action'       => 'index',
        'module'       => 'merch',
        'namespace'    => 'HC\Merch\Controllers\\',
    )
);

/**
 * matches: /merch/ja_JP/Summer-Escape/Asia/India/Bangalore/
 */
$router->add(
    '/n/merch' . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . RE_SEOPATH_ALPHA . RE_SEOPATH_ALPHA . '/:params',
    array(
        'languageCode' => 1,
        'campaignName' => 2,
        'regionName'   => 3,
        'countryName'  => 4,
        'cityName'     => 5,
        'params'       => 6,
        'controller'   => 'index',
        'action'       => 'index',
        'module'       => 'merch',
        'namespace'    => 'HC\Merch\Controllers\\',
    )
);


/**
 * API Routers
 * api/recommend
 */
$router->add(
    '/n/api/recommend/:params',
    array(        
        'params'       => 1,
        'controller'   => 'index',
        'action'       => 'recommend',
        'module'       => 'api',
        'namespace'    => 'HC\Api\Controllers\\',
    )
);



/**
 * Set default route
 */
$defaultRoutePaths = [
    'module'     => DEFAULT_ROUTE_MODULE,
    'namespace'  => DEFAULT_ROUTE_NAMESPACE,
    'controller' => DEFAULT_ROUTE_CONTROLLER,
    'action'     => DEFAULT_ROUTE_ACTION,
    'language'   => DEFAULT_ROUTE_LOCALE
];
$router->setDefaults($defaultRoutePaths)->add('/', $defaultRoutePaths);

return $router;
