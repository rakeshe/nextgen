<?php
/**
 *
 * @author     K.N. Santosh Hegde
 * @package    Api Module
 * @since      23/10/14
 * @version    1.0
 */

namespace HC\Api;

class Module {

    public function registerAutoloaders() {
       
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'HC\Api\Controllers' => __DIR__ . '/'.static::getConfig()->application->controllersDir,
            'HC\Api\Models' => __DIR__ . '/'. static::getConfig()->application->modelsDir,            
            'HC\Library' => __DIR__ . "/../../vendor/library"
        ));
        $loader->register();
    }

    public function registerServices($di) {
        
        $di->set('view', function() {
            $view = new \Phalcon\Mvc\View();
            $view->disable();
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
           $obj = new \HC\Library\Couchbase($conf['bucket'], $conf['host'], $conf['port'], $conf['user'], $conf['password']);
           $obj->connect();
          return $obj->couchbase;
       });      
        
    }
    
    public static function getConfig() {
        return include __DIR__.'/config/config.php';
    }
    
}