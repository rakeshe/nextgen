<?php

$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);

/**
 * Frontend routes
 */
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
	'action' => 'index'
));

return $router;
