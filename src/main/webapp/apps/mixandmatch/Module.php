<?php
/**
 *
 * @package    Module (mixandmatch Module bootstrap file)
 * @author     K.N. Santosh Hegde
 * @since      09/02/2015
 * @version    1.0
 */

namespace HC\MixAndMatch;

//load swift message
require __DIR__.'/../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

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
                //This binds the function php function to volt function
                $compiler = $volt->getCompiler();
                $compiler->addFunction('ucfirst', 'ucfirst');
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
    