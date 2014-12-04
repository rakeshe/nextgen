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
						'ascott_specials' => 'http://pubads.g.doubleclick.net/gampad/clk?id=196562329&iu=/51621329/hcl/click_tracker'
				),
				'languageOptions' => array (
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
        ]
) );
