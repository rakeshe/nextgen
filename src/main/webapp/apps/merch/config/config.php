<?php
return new \Phalcon\Config ( array (
		'themes' => array (
				'default' => 'default theme',
				'geo-map' => 'GEO Map',	
		),
		'database' => array (
				'adapter' => 'Mysql',
				'host' => 'localhost',
				'username' => 'root',
				'password' => '',
				'dbname' => 'test' 
		),
		'couchbase' => array (
//				'bucket' => 'hc-nextgen'
				'bucket' => 'hc-cache'
		),
		'menuItems' => array (
				'site' => array (
						'menu_travel_insurance' => 'http://www.hotelclub.com/travel-insurance' 
				),
				'rightSite' => array (
						'ascott_specials' => 'http://www.hotelclub.com/p/brand-usa/'
				),
				'languageOptions' => array (
						'en_AU' => 'English',
						'zh_TW' => '繁體中文 (台灣)',
						'zh_CN' => '简体中文',
                        'zh_HK' => '繁體中文 (香港)',
                        'ms_MY' => 'Bahasa Melayu',
                        'de_DE' => 'Deutsch',
                        'es_ES' => 'Español',
                        'fr_FR' => 'Français',
                        'it_IT' => 'Italiano',
                        'ja_JP' => '日本語',
                        'ko_KR' => '한국어',
//                        'id_ID' => 'Bahasa Indonesia',
						'nl_NL' => 'Nederlands',
						'pt_PT' => 'Português',
						'ru_RU' => 'Русский',
						'sv_SE' => 'Svenska',
						'th_TH' => 'ไทย',

				) 
		),
		'application' => array (
				'controllersDir' => 'controllers/',
				'modelsDir' => 'models/',
				'viewsDir' => 'views/themes/',
				'helpersDir' => 'helpers/',
				'formsDir' => 'forms/',
				'LanguageDir' => 'merch/language/',
				'componentDir' => 'library/' 
		),
		'metadata' => array (
				'adapter' => 'Apc',
				'suffix' => 'my-suffix',
				'lifetime' => 86400 
		),
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
        'dateFormat' => [
            'default' => [
                'value' => 'dd/mm/y',
                'placeholder' => 'dd/mm/yy'
            ],
            'locale' => [
                'zh_HK' => [
                    'value' => 'y/mm/dd',
                    'placeholder' => 'yy/mm/dd',
                    ],
                'zh_CN' => [
                    'value' => 'yy-mm-dd',
                    'placeholder' => 'yyyy-mm-dd'
                ]
            ]
        ]
) );
