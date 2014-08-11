<?php

$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);

define('MODULE_NAME', '/([a-z\-]+)');
define('RE_SEOPATH_ALPHANUM', '/([a-zA-Z0-9\-]+)');
define('RE_SEOPATH_ALPHA', '/([a-zA-Z\-]+)');
define('RE_LANGUAGE_CODE', '/([a-zA-z\_]{2,5})');
define('DEFAULT_ROUTE_CONTROLLER', 'index');
define('DEFAULT_ROUTE_ACTION', 'page');

//default
$router->add('', array(
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
    'controller' => 'index',
    'action' => 'index'
));

$router->add('/', array(
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
    'controller' => 'index',
    'action' => 'index'
));

/**
 * Set language route
 */
$router->add(
        "/set-language/{language:[a-z]+}", array(
    'controller' => 'index',
    'action' => 'setLanguage',
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
        )
);

/** 
 * matches: /merch/ja_JP/Summer-Escape/
 */
$router->add(
        MODULE_NAME . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . '/:params', array(
    "languageCode" => 2,
    "campaignName" => 3,
    "params" => 4,
    "controller" => 'campaign',
    "action" => 'index',
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
        )
);

/** 
 * matches: merch/ja_JP/Summer-Escape/Asia/
 */
$router->add(
        MODULE_NAME . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . '/:params', array(
    'languageCode' => 2,
    'campaignName' => 3,
    'regionName' => 4,    
    'params' => 5,
    'controller' => 'campaign',
    'action' => 'region',
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
        )
);

/**
 * matches: merch/ja_JP/Summer-Escape/Asia/India/
 */
$router->add(
        MODULE_NAME . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . RE_SEOPATH_ALPHA. '/:params', array(
    'languageCode' => 2,
    'campaignName' => 3,
    'regionName' => 4,
    'countryName' => 5,   
    'params' => 6,
   'controller' => 'campaign',
    'action' => 'country',
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
        )
);

/**
 * matches: /merch/ja_JP/Summer-Escape/Asia/India/Bangalore/
 */
$router->add(
        MODULE_NAME . RE_LANGUAGE_CODE . RE_SEOPATH_ALPHANUM . RE_SEOPATH_ALPHA . RE_SEOPATH_ALPHA. RE_SEOPATH_ALPHA .'/:params', array(
    'languageCode' => 2,
    'campaignName' => 3,
    'regionName' => 4,
    'countryName' => 5,
    'cityName' => 6,
    'params' => 7,
    'controller' => 'campaign',
    'action' => 'city',
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
        )
);

/**
 * matches: /travel-insurance
 */
$router->add('/travel-insurance', array(
    'module' => 'ti',
    'namespace' => 'HC\TI\Controllers\\',
    'controller' => 'index',
    'action' => 'index',
    "params" => 4,
));

//Set 404 paths
$router->notFound(array(
    'module' => 'merch',
    'namespace' => 'HC\Merch\Controllers\\',
    'controller' => 'Error',
    'action' => 'show404',
));


return $router;
