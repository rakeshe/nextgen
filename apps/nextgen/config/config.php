<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'test',
    ),
    'application' => array(
        'controllersDir' => 'controllers/',
        'modelsDir' => 'models/',
        'viewsDir' => 'views/',
        'formsDir' => 'forms/',
        'LanguageDir' => 'nextgen/language/'
    ),
    'metadata' => array(
        'adapter' => 'Apc',
        'suffix' => 'my-suffix',
        'lifetime' => 86400
    ),
    'locales' => array(
        'MS' => 'ms_MY',
        'CN' => 'zh_TW',
        'CS' => 'zh_CN',
        'HK' => 'zh_HK',
        'EN' => 'en_AU',
        'DE' => 'de_DE',
        'ES' => 'es_ES',
        'FR' => 'fr_FR',
        'IT' => 'it_IT',
        'JP' => 'ja_JP',
        'KR' => 'ko_KR',
        'NL' => 'nl_NL',
        'PL' => 'pl_PL',
        'PT' => 'pt_PT',
        'RU' => 'ru_RU',
        'SV' => 'sv_SE',
        'TH' => 'th_TH'
    )
        ));
