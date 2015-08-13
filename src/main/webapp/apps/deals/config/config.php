<?php
return new \Phalcon\Config ([
		'themes' => array (
				'default' => 'default theme',
		),
		'couchbase' => array (
//				'bucket' => 'hc-nextgen'
				'bucket' => 'hc-cache'
		),
		'application' => array (
				'controllersDir' => 'controllers/',
				'modelsDir' => 'models/',
				'viewsDir' => 'views/themes/',
		),
		'metadata' => array (
				'adapter' => 'Apc',
				'suffix' => 'my-suffix',
				'lifetime' => 86400 
		),
        'languageOptions' => array (
            'en_AU' => ['name' => 'English', 'class' => 'flag-au'],
            /*'zh_TW' => ['name' => '繁體中文 (台灣)', 'class' => 'flag-tw'],
            'zh_CN' => ['name' => '简体中文', 'class' => 'flag-cn'],
            'zh_HK' => ['name' => '繁體中文 (香港)', 'class' => 'flag-hk'],
            'ms_MY' => ['name' => 'Bahasa Melayu', 'class' => 'flag-my'],
            'de_DE' => ['name' => 'Deutsch', 'class' => 'flag-de'],
            'es_ES' => ['name' => 'Español', 'class' => 'flag-es'],
            'fr_FR' => ['name' => 'Français', 'class' => 'flag-fr'],
            'it_IT' => ['name' => 'Italiano', 'class' => 'flag-it'],
            'ja_JP' => ['name' => '日本語', 'class' => 'flag-jp'],
            'ko_KR' => ['name' => '한국어', 'class' => 'flag-kr'],
            'id_ID' => ['name' => 'Bahasa Indonesia', 'class' => 'flag-id'],
            'nl_NL' => ['name' => 'Nederlands', 'class' => 'flag-nl'],
            'pl_PL' => ['name' => 'Polski', 'class' => 'flag-pl'],
            'pt_PT' => ['name' => 'Português', 'class' => 'flag-pt'],
            'ru_RU' => ['name' => 'Русский', 'class' => 'flag-ru'],
            'sv_SE' => ['name' => 'Svenska', 'class' => 'flag-se'],
            'th_TH' => ['name' => 'ไทย', 'class' => 'flag-th'],*/
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
				/*'most-used-currencies' => array (
						'AUD' => '$AUD - Australian Dollar',
						'CNY' => '¥CNY - Chinese Yuan',
						'EUR' => '€EUR - Euro体中文',
						'GBP' => '£GBP - British Pound Sterling',
						'INR' => '₹INR - Indian Rupee',
						'NZD' => '$NZD - New Zealand Dollar',
						'USD' => '$USD - US Dollar'
				),
				'africa' => array (
						'ZAR' => 'R ZAR - South African Rand'
				),
				'americas' => array (
						'BRL' => 'R$BRL - Brazilian Real',
						'CAD' => '$CAD - Canadian Dollar',
						'COP' => '$COP - Colombia Peso',
						'MXN' => '$MXN - Mexican Peso',
						'USD' => '$USD - US Dollar'
				),
				'asia' => array (
						'CNY' => '¥CNY - Chinese Yuan',
						'HKD' => '$HKD - Hong Kong Dollar',
						'IDR' => 'RpIDR - Indonesia Rupiah',
						'INR' => '₹INR - Indian Rupee',
						'JPY' => '¥JPY - Japanese Yen',
						'KRW' => '₩KRW - South Korean Won',
						'MYR' => 'RM MYR - Malaysian Ringgit',
						'PHP' => '₱PHP - Philippine Peso',
						'SGD' => '$SGD - Singapore Dollar',
						'THB' => '฿THB - Thai Baht',
						'TWD' => '$TWD - New Taiwan Dollar'
				),
				'middle-east' => array (
						'AED' => 'د.إAED - UAE Dirham',
						'ILS' => '₪ILS - Israeli New Sheqel',
						'QAR' => 'ر.قQAR - Qatar Rial',
						'SAR' => 'ر.سSAR - Saudi Arabia Riyal',
						'TRY' => 'TRY - Turkish Lira'
				),
				'europe' => array (
						'CHF' => 'FrCHF - Swiss Franc',
						'CZK' => 'KčCZK - Czech Republic Koruna',
						'DKK' => 'krDKK - Danish Krone',
						'EUR' => '€EUR - Euro',
						'GBP' => '£GBP - British Pound Sterling',
						'HUF' => 'FtHUF - Hungary Forint',
						'NOK' => 'krNOK - Norwegian Krone',
						'PLN' => 'złPLN - Polish Zloty',
						'RUB' => '₽RUB - Russian Ruble',
						'SEK' => 'krSEK - Swedish Krona',
						'UAH' => '₴UAH - Ukrainian Hryvnia'
				),*/
				'oceania' => array (
						'AUD' => '$AUD - Australian Dollar',
						'NZD' => '$NZD - New Zealand Dollar'
				) 
		) ,
        'currencyGroup' => [
//           0 => ['most-used-currencies','africa', 'americas'],
//           1 => ['asia','middle-east'],
//           2 => ['europe','oceania']
           0 => ['oceania']
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
        ],

   'sortBy' => [
       'price',
       'name',
       'rating',
       'ourPicks'
   ]
]);
