<?php

namespace HC\Common;

class Module {

    public function registerAutoloaders() {

        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces(array(
                'HC\HkCalendar\Controllers' => __DIR__ . '/controllers/',
                'HC\HkCalendar\Models' => __DIR__ . '/models/'
            ));
        $loader->register();
    }

    public function registerServices($di) {

        $di->set('view', function() {

                $view = new \Phalcon\Mvc\View();

                $view->setViewsDir(__DIR__.'/views/');

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

    }

}
