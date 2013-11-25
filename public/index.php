<?php

error_reporting(E_ALL);

try {

    /**
     * Read the configuration
     */
    $config = new Phalcon\Config\Adapter\Ini(__DIR__ . '/../app/config/config.ini');

    $loader = new \Phalcon\Loader();

    /**
     * We're a registering a set of directories taken from the configuration file
     */
    $loader->registerDirs(
        array(
            __DIR__ . $config->application->controllersDir,
            __DIR__ . $config->application->pluginsDir,
            __DIR__ . $config->application->libraryDir,
            __DIR__ . $config->application->languageDir,
            __DIR__ . $config->application->modelsDir,
        )
    )->register();

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Set up router before we dispatch
     */

    $di->set('router', function(){
            require __DIR__.'/../app/config/routes.php';
            $router = new configRouter();
            return $router;
        });

    /**
     * We register the events manager
     */
    $di->set(
        'dispatcher',
        function () use ($di) {

            $eventsManager = $di->getShared('eventsManager');

            /**
             * Handle 404
             */
            $eventsManager->attach(
                "dispatch:beforeException",
                function($event, $dispatcher, $exception)
                {
                    switch ($exception->getCode()) {
                        case \Phalcon\Mvc\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                        case \Phalcon\Mvc\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                            $dispatcher->forward(
                                array(
                                    'controller' => 'error',
                                    'action'     => 'show404',
                                )
                            );
                            return false;
                    }
                }
            );

            $security = new Security($di);

            /**
             * We listen for events in the dispatcher using the Security plugin
             */
            $eventsManager->attach('dispatch', $security);

            $dispatcher = new Phalcon\Mvc\Dispatcher();
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        }
    );

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    $di->set(
        'url',
        function () use ($config) {
            $url = new \Phalcon\Mvc\Url();
            $url->setBaseUri($config->application->baseUri);
            return $url;
        }
    );


    $di->set(
        'view',
        function () use ($config) {

            $view = new \Phalcon\Mvc\View();

            $view->setViewsDir(__DIR__ . $config->application->viewsDir);

            $view->registerEngines(
                array(
                    ".volt" => 'volt',
                    ".phtml" => 'Phalcon\Mvc\View\Engine\Volt'
                )
            );
            return $view;
        }
    );

    /**
     * Setting up volt
     */
    $di->set(
        'volt',
        function ($view, $di) {

            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(
                array(
                    "compiledPath" => "../cache/volt/"
                )
            );

            return $volt;
        },
        true
    );

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->set(
        'db',
        function () use ($config) {
            return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host"     => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname"   => $config->database->name
            ));
        }
    );

    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    $di->set(
        'modelsMetadata',
        function () use ($config) {
            if (isset($config->models->metadata)) {
                $metaDataConfig  = $config->models->metadata;
                $metadataAdapter = 'Phalcon\Mvc\Model\Metadata\\' . $metaDataConfig->adapter;
                return new $metadataAdapter();
            }
            return new Phalcon\Mvc\Model\Metadata\Memory();
        }
    );

    /**
     * Start the session the first time some component request the session service
     */
    $di->set(
        'session',
        function () {
            $session = new Phalcon\Session\Adapter\Files();
            $session->start();
            return $session;
        }
    );

    /**
     * Register the flash service with custom CSS classes
     */
    $di->set(
        'flash',
        function () {
            return new Phalcon\Flash\Direct(array(
                'error'   => 'alert alert-error',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
            ));
        }
    );

    /**
     * Register a user component
     */
    $di->set(
        'elements',
        function () {
            return new Elements();
        }
    );

    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
// Default
    //echo $e->getMessage();
/*    // TODO log exception

    // remove view contents from buffer
    ob_clean();

    $errorCode = 500;
    $errorView = 'errors/500_error.phtml';

    switch (true) {
        // 401 UNAUTHORIZED
        case $e->getCode() == 401:
            $errorCode = 401;
            $errorView = 'errors/401_unathorized.phtml';
            break;

        // 403 FORBIDDEN
        case $e->getCode() == 403:
            $errorCode = 403;
            $errorView = 'errors/403_forbidden.phtml';
            break;

        // 404 NOT FOUND
        case $e->getCode() == 404:
        case ($e instanceof Phalcon\Mvc\View\Exception):
        case ($e instanceof Phalcon\Mvc\Dispatcher\Exception):
            $errorCode = 404;
            $errorView = 'views/404/404.volt';
            break;
    }

    // Get error view contents. Since we are including the view
    // file here you can use PHP and local vars inside the error view.
    ob_start();
    include_once $errorView;
    $contents = ob_get_contents();
    ob_end_clean();

    // send view to header
    $response = $application->getDI()->getShared('response');
    $response->resetHeaders()
        ->setStatusCode($errorCode, null)
        ->setContent($contents)
        ->send();*/

} catch (PDOException $e) {
    echo $e->getMessage();
}