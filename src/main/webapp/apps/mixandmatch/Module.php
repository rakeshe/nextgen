<?php
/**
 *
 * @package    Module (mixandmatch Module bootstrap file)
 * @author     K.N. Santosh Hegde
 * @since      09/02/2015
 * @version    1.0
 */

namespace HC\MixAndMatch;

class Module {

    public function registerAutoloaders() {
       
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces(array(
            'HC\MixAndMatch\Controllers' => __DIR__ . '/controllers/',
            'HC\MixAndMatch\Models' => __DIR__ . '/models/'
        ));
        $loader->register();
    }

    public function registerServices($di) {

        $di->set('view', function() {

            $view = new \Phalcon\Mvc\View();

            $view->setViewsDir(__DIR__.'/views/themes/');

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
        
    }
    
}
    