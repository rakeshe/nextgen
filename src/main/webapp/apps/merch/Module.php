<?php
/**
 *
 * @package    Module (Nextgen Module bootstrap file)
 * @author     K.N. Santosh Hegde
 * @since      28/7/2014
 * @version    1.0
 */

namespace HC\Merch;

class Module {

    public function registerAutoloaders() {
       
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces(array(
            'HC\Merch\Controllers' => __DIR__ . '/'.static::getConfig()->application->controllersDir,
            'HC\Merch\Models' => __DIR__ . '/'. static::getConfig()->application->modelsDir,            
            'HC\Merch\Helpers' => __DIR__ . '/'. static::getConfig()->application->helpersDir,
            'HC\Library' => __DIR__ . "/../../vendor/library",
            'HC\Forms' => __DIR__ . '/' . static::getConfig()->application->formsDir,
            'HC\Merch\Library' => __DIR__ . '/' . static::getConfig()->application->componentDir,
        ));
        $loader->registerClasses(
        		array(
        				"simple_html_dom" => __DIR__ . "/../../vendor/library/simple_html_dom.php"
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
       
       //set element class to di
       /*
       $di->set('elements', function() {
          return new \HC\Merch\Library\Elements();
       });
        */
       //set the helper class to di
       $di->set('HotelHelper', function(){
        return new \HC\Merch\Helpers\HotelHelper();
       });
       
       //set the couch class to di      
       $di->set('Couch', function() use($di){
           $conf = $di->get('config')->couchbase;
               return new \Couchbase(
                   $conf->host . ':' . $conf->port,
                   '',//$config->couchbase->user,
                   $conf->password,
                   $conf->bucket
               );
       });      
        
    }
    
    public static function getConfig() {
        return include __DIR__.'/config/config.php';
    }
    
}