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
            'HC\Forms' => __DIR__ . '/' . static::getConfig()->application->formsDir
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
            //This binds the function name 'shuffle' in Volt to the PHP function 'str_shuffle'
            $compiler->addFunction('print_r', 'print_r');

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