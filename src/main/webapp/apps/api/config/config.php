<?php

return new \Phalcon\Config(array(
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
    'themes' => [
        'merch' => [
            'merch' => 'World on sale sale'
            ],
        'carousel' => [
            'default' => 'default theme'
        ]
    ],
    'themeMode' => [
        'desktop' => 'World on sale sale',
        'mobile'  => '',
        'tablet'  => '',
    ],
    'scope' => ['full', 'partial'],
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
        ],
    'locales' => array (
        'MY' => 'ms_MY',
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
        'TH' => 'th_TH' ,
        'ID' => 'id_ID'
    ),
    'currencies' => array (
        'most-used-currencies' => array (
            'AUD' => 'Australian Dollar',
            'CNY' => 'Chinese Yuan',
            'EUR' => 'Euro体中文',
            'GBP' => 'British Pound Sterling',
            'INR' => 'Indian Rupee',
            'NZD' => 'New Zealand Dollar',
            'USD' => 'US Dollar'
        ),
        'africa' => array (
            'ZAR' => 'South African Rand'
        ),
        'americas' => array (
            'BRL' => 'Brazilian Real',
            'CAD' => 'Canadian Dollar',
            'COP' => 'Colombia Peso',
            'MXN' => 'Mexican Peso',
            'USD' => 'US Dollar'
        ),
        'asia' => array (
            'CNY' => 'Chinese Yuan',
            'HKD' => 'Hong Kong Dollar',
            'IDR' => 'Indonesia Rupiah',
            'INR' => 'Indian Rupee',
            'JPY' => 'Japanese Yen',
            'KRW' => 'South Korean Won',
            'MYR' => 'Malaysian Ringgit',
            'PHP' => 'Philippine Peso',
            'SGD' => 'Singapore Dollar',
            'THB' => 'Thai Baht',
            'TWD' => 'New Taiwan Dollar'
        ),
        'middle-east' => array (
            'AED' => 'UAE Dirham',
            'ILS' => 'Israeli New Sheqel',
            'QAR' => 'Qatar Rial',
            'SAR' => 'Saudi Arabia Riyal',
            'TRY' => 'Turkish Lira'
        ),
        'europe' => array (
            'CHF' => 'Swiss Franc',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Danish Krone',
            'EUR' => 'Euro',
            'GBP' => 'British Pound Sterling',
            'HUF' => 'Hungary Forint',
            'NOK' => 'Norwegian Krone',
            'PLN' => 'Polish Zloty',
            'RUB' => 'Russian Ruble',
            'SEK' => 'Swedish Krona',
            'UAH' => 'Ukrainian Hryvnia'
        ),
        'oceania' => array (
            'AUD' => 'Australian Dollar',
            'NZD' => 'New Zealand Dollar'
        )
    ) ,
    'currencyGroup' => [
        0 => ['most-used-currencies','africa', 'americas'],
        1 => ['asia','middle-east'],
        2 => ['europe','oceania']
    ],
    'fontStyles' => [
        'small' => ['fr_FR', 'it_IT', 'es_ES', 'de_DE', 'ru_RU', 'pt_PT', 'ms_MY', 'nl_NL', 'sv_SE'],
        'large' => ['zh_CN','zh_HK','th_TH', 'ko_KR']
    ],
    'whiteListDomains' => [
        'www.hotelclub.com',
        'www.hotelclub.cn',
        'cmsref.hotelclub.com',
        'hotelclub.com',
        'qa1.hclubtest.com',
        'qa1.hclubtest.cn'
    ]
));
