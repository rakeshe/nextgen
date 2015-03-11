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
    'secretKey' => [
        'salt' => '8765639052'
    ],
    'cacheConfig' => [
        'enableCacheLocale' => ['en_AU', 'zh_HK'], // which locale need to be cached
        'documentLifetime' => 30,            // cache life time (if 0 == lifetime)
        //'cacheMoreThen' => 10 // cache when more then 10 onegid request comes
    ],
        /*
         * var supportedLanguages = {
        'ar': 'ARABIC',
        'eu': 'BASQUE',
        'bg': 'BULGARIAN',
        'bn': 'BENGALI',
        'ca': 'CATALAN',
        'cs': 'CZECH',
        'da': 'DANISH',
        'de': 'GERMAN',
        'el': 'GREEK',
        'en': 'ENGLISH',
        'en-AU': 'ENGLISH (AUSTRALIAN)',
        'en-GB': 'ENGLISH (GREAT BRITAIN)',
        'es': 'SPANISH',
        'eu': 'BASQUE',
        'fa': 'FARSI',
        'fi': 'FINNISH',
        'fil': 'FILIPINO',
        'fr': 'FRENCH',
        'gl': 'GALICIAN',
        'gu': 'GUJARATI',
        'hi': 'HINDI',
        'hr': 'CROATIAN',
        'hu': 'HUNGARIAN',
        'id': 'INDONESIAN',
        'it': 'ITALIAN',
        'iw': 'HEBREW',
        'ja': 'JAPANESE',
        'kn': 'KANNADA',
        'ko': 'KOREAN',
        'lt': 'LITHUANIAN',
        'lv': 'LATVIAN',
        'ml': 'MALAYALAM',
        'mr': 'MARATHI',
        'nl': 'DUTCH',
        'no': 'NORWEGIAN',
        'pl': 'POLISH',
        'pt': 'PORTUGUESE',
        'pt-BR': 'PORTUGUESE (BRAZIL)',
        'pt-PT': 'PORTUGUESE (PORTUGAL)',
        'ro': 'ROMANIAN',
        'ru': 'RUSSIAN',
        'sk': 'SLOVAK',
        'sl': 'SLOVENIAN',
        'sr': 'SERBIAN',
        'sv': 'SWEDISH',
        'tl': 'TAGALOG',
        'ta': 'TAMIL',
        'te': 'TELUGU',
        'th': 'THAI',
        'tr': 'TURKISH',
        'uk': 'UKRAINIAN',
        'vi': 'VIETNAMESE',
        'zh-CN': 'CHINESE (SIMPLIFIED)',
        'zh-TW': 'CHINESE (TRADITIONAL)'
      };
         */
        'googleLanguage' => [
            'en_AU' => 'en-AU',
            'zh_TW' => 'zh-TW',
            'zh_CN' => 'zh-CN',
            'zh_HK' => 'zh-HK',
            'ms_MY' => 'ml',
            'de_DE' => 'de',
            'es_ES' => 'es',
            'fr_FR' => 'fr',
            'it_IT' => 'it',
            'ja_JP' => 'ja',
            'ko_KR' => 'ko',
            'id_ID' => 'id',
            'nl_NL' => 'nl',
            'pt_PT' => 'pt-PT',
            'ru_RU' => 'ru',
            'sv_SE' => 'sv',
            'th_TH' => 'th',
        ]
   
));
