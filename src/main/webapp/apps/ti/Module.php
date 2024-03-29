<?php
/**
 *
 * @package    Module (Trivel Insurance Module bootstrap file)
 * @author     K.N. Santosh Hegde
 * @since      24/7/2014
 * @version    1.0
 */

namespace HC\TI;

class Module {

    public function registerAutoloaders() {
       
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces(array(
            'HC\TI\Controllers' => __DIR__ . '/'.static::getConfig()->application->controllersDir,
            'HC\TI\Models' => __DIR__ . '/'. static::getConfig()->application->modelsDir,            
            'HC\Library' => __DIR__ . "/../../vendor/library",
            'HC\Forms' => __DIR__ . '/' . static::getConfig()->application->formsDir
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

            $view = new \Phalcon\Mvc\View();

            $view->setViewsDir(__DIR__.'/'.static::getConfig()->application->viewsDir);

            $view->registerEngines(array(
                '.volt' => function($view, $di) {

            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(array(
                'compiledPath' => __DIR__.'/../../data/volt/',
                'compiledSeparator' => '_',
            ));

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
    }
    
    public static function getConfig() {
        return include __DIR__.'/config/config.php';
    }
    
}
    