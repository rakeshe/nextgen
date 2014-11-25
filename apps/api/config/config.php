<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'test',
    ),
    'couchbase' => array(
        'bucket' => 'hc-nextgen'
//        'bucket' => 'hc-cache'
    ),
    'application' => array(
        'controllersDir' => 'controllers/',
        'modelsDir' => 'models/'
    ),
   
));
