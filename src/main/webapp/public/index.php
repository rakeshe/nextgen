<?php
/**
 *
 * @package    index file
 * @author     K.N. Santosh Hegde
 * @since      24/7/2014
 * @version    1.0
 */
try {

	/**
	 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
	 */
	$di = new \Phalcon\DI\FactoryDefault();

	/**
	 * Registering a router
	 */
	$di->set('router', require __DIR__.'/../config/routes.php');

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() {
		$url = new \Phalcon\Mvc\Url();

		$url->setBaseUri('/n/'); // If the project is in the Document Root folder, setBaseUri to '/'
		return $url;
	});

	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function() {
        ini_set('session.save_path', __DIR__ . '/../data/cache');
		$session = new \Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	});
	
	$di->set('cookies', function() {
		$cookies = new Phalcon\Http\Response\Cookies();
		$cookies->useEncryption(false);
		return $cookies;
	});
	
    //Register Global configuration
    $di->set('config', require __DIR__ . '/../config/global.config.php');

	//Set the views cache service
	$di->set('viewCache', function(){

		//Cache data for one day by default
		$frontCache = new Phalcon\Cache\Frontend\Output(array(
			"lifetime" => 86400
		));

		//File backend settings
		$cache = new Phalcon\Cache\Backend\File($frontCache, array(
			"cacheDir" => __DIR__."/../data/cache/",
		));

		return $cache;
	});

	/**
	 * Main logger file
	 */
	$di->set('logger', function() {
		return new \Phalcon\Logger\Adapter\File(__DIR__.'/../data/logs/'.date('Y-m-d').'.log');
	}, true);

	/**
	 * Error handler
	 */
	set_error_handler(function($errno, $errstr, $errfile, $errline) use ($di)
	{
		if (!(error_reporting() & $errno)) {
			return;
		}

		$di->getFlash()->error($errstr);
		$di->getLogger()->log($errstr.' '.$errfile.':'.$errline, Phalcon\Logger::ERROR);

		return true;
	});

	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application();

	$application->setDI($di);

	/**
	 * Register application modules
	 */
	$application->registerModules(require __DIR__.'/../config/app.config.php');

	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
}
