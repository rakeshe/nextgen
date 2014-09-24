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

        $loader->register();
    }

    public function registerServices($di) {

        $di->set('view', function() {

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
            //This binds the function ex: name 'shuffle' in Volt to the PHP function 'str_shuffle'
            $compiler->addFunction('print_r', 'print_r');
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
           $obj = new \HC\Library\Couchbase($conf['host'], $conf['user'], $conf['password'], $conf['bucket']);
           $obj->connect();           
          return $obj->couchbase;
       });      
        
    }
    
    public static function getConfig() {
        return include __DIR__.'/config/config.php';
    }
    
}