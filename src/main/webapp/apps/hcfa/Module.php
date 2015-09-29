<?php
/**
 *
 * @package    Module (deals Module bootstrap file)
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\HCFA;


class Module {

    public function registerAutoloaders() {
       
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces([
            'HC\HCFA\Controllers' => __DIR__ . '/'.static::getConfig()->application->controllersDir,
            'HC\HCFA\Models' => __DIR__ . '/'. static::getConfig()->application->modelsDir,
            'Phalcon' => __DIR__ .  '/../../vendor/incubator/Library/Phalcon/'
        ]);

        $loader->registerClasses(
            array(
                "MCAPI" => __DIR__ . "/../../vendor/library/MCAPI.class.php"
            )
        );

        $loader->register();
    }

    public function registerServices($di) {

        $di->set('view', function() {

            // Folder health checks
            if (!file_exists(__DIR__.'/../../data/volt/')) {
                mkdir(__DIR__.'/../../data/volt/', 0777, true);
            }
            if (!file_exists(__DIR__.'/../../data/cache/')) {
                mkdir(__DIR__.'/../../data/cache/', 0777, true);
            }
            if (!file_exists(__DIR__.'/../../data/logs/')) {
                mkdir(__DIR__.'/../../data/logs/', 0777, true);
            }
            $view = new \Phalcon\Mvc\View();

            $view->setViewsDir(__DIR__.'/'.static::getConfig()->application->viewsDir);

            $view->registerEngines(array(
                '.volt' => function($view, $di) {

            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(array(
                'compiledPath' => __DIR__.'/../../data/volt/',
                'compiledSeparator' => '_',
            ));
            $compiler = $volt->getCompiler();

            //This binds the function php function to volt function
            $compiler->addFunction('print_r', 'print_r');
            $compiler->addFunction('empty', 'empty');
            $compiler->addFunction('isArray', 'is_array');
            $compiler->addFunction('substr', 'substr');			

            return $volt;
        },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php' // Generate Template files uses PHP itself as the template engine
            ));

            return $view;
        }, true);
        
       //To override Global configuration with module config..
       //Get global config, override with module config and set to DI
       $globalConfig = $di->get('config');
       $globalConfig->merge(static::getConfig());
       $di->set('config', $globalConfig);

       //set the couch class to di      
       $di->set('Couch', function() use($di){
           $conf = $di->get('config')->couchbase;
               $couch = new \Couchbase(
                   $conf->host . ':' . $conf->port,
                   '',//$config->couchbase->user,
                   $conf->password,
                   $conf->bucket
               );
               $couch->setTimeout(60 * 10000000);
               return $couch;
       });

    }
    
    public static function getConfig() {
        return include __DIR__.'/config/config.php';
    }
    
}