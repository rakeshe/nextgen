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
    ),
    'menuItems' => array(
        'site' => array(
            'menu_travel_insurance' => 'http://www.hotelclub.com/travel-insurance'
        ),
        'rightSite' => array(
            'ascott_specials' => 'http://www.revresda.com/event.ng/Type=click&FlightID=236487&AdID=458542&TargetID=53988&ASeg=&AMod=&Segments=65,406,4979,7949,8303,11672,12591,39489,47055,50404,60715,61817,64040,74252,80088,85776,85777&Targets=53988&Values=81,90,100,31103,32876,33112,33119,33156,33234,34172,34641,34959,34960,35048,35272,35582,35643,35657,35682,35771,35793,36063,36105,36112,36138,68032,68088,68179,68180,68236,68270,68318,68322,68325,68326,68359,68363,68367,68375,96191,102874,102875,103013,103016,103078,103455,108536,113294&RawValues=NGUSERID%2Ca32a420-11187-519196470-1&WebLogicSession=&Params.User.UserID=a32a420-11187-519196470-1&Redirect=http%3A%2F%2Fwww.hotelclub.com%2Fhotels%2Fascott-offer'
        ),
        'languageOptions' => array(
            'en_AU' => 'English',
            'zh_TW' => '繁體中文 (台灣)',
            'zh_CN' => '简体中文',
            'de_DE' => 'Deutsch',
            'es_ES' => 'Español',
            'fr_FR' => 'Français',
            'zh_HK' => '繁體中文 (香港)',
            'it_IT' => 'Italiano',
            'ja_JP' => '日本語',
            'ko_KR' => '한국어',
            'ms_MY' => 'Bahasa Melayu',
            'nl_NL' => 'Nederlands',
            'pt_PT' => 'Português',
            'ru_RU' => 'Русский',
            'sv_SE' => 'Svenska',
            'th_TH' => 'ไทย'
        ),
    ),
    'application' => array(
        'controllersDir' => 'controllers/',
        'modelsDir' => 'models/',
        'viewsDir' => 'views/',
        'helpersDir' => 'helpers/',
        'formsDir' => 'forms/',
        'LanguageDir' => 'merch/language/',
        'componentDir' => 'library/'
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
