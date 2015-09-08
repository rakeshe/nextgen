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
                'libraryDir' => 'library/'
		),
		'metadata' => array (
				'adapter' => 'Apc',
				'suffix' => 'my-suffix',
				'lifetime' => 86400 
		),
        'languageOptions' => array (
            'en_AU' => ['name' => 'English', 'class' => 'flag-au'],
            'zh_TW' => ['name' => '繁體中文 (台灣)', 'class' => 'flag-tw'],
            'zh_CN' => ['name' => '简体中文', 'class' => 'flag-cn'],
            'zh_HK' => ['name' => '繁體中文 (香港)', 'class' => 'flag-hk'],
            'ja_JP' => ['name' => '日本語', 'class' => 'flag-jp'],
            'ms_MY' => ['name' => 'Bahasa Melayu', 'class' => 'flag-my'],
            'de_DE' => ['name' => 'Deutsch', 'class' => 'flag-de'],
            'es_ES' => ['name' => 'Español', 'class' => 'flag-es'],
            'fr_FR' => ['name' => 'Français', 'class' => 'flag-fr'],
            'it_IT' => ['name' => 'Italiano', 'class' => 'flag-it'],
            'ko_KR' => ['name' => '한국어', 'class' => 'flag-kr'],
            'id_ID' => ['name' => 'Bahasa Indonesia', 'class' => 'flag-id'],
            'nl_NL' => ['name' => 'Nederlands', 'class' => 'flag-nl'],
            'pl_PL' => ['name' => 'Polski', 'class' => 'flag-pl'],
            'pt_PT' => ['name' => 'Português', 'class' => 'flag-pt'],
            'ru_RU' => ['name' => 'Русский', 'class' => 'flag-ru'],
            'sv_SE' => ['name' => 'Svenska', 'class' => 'flag-se'],
            'th_TH' => ['name' => 'ไทย', 'class' => 'flag-th'],
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
				'most_used_currencies' => array (
						'AUD' => 'AUD - australian_dollar',
						'CNY' => 'CNY - chinese_yuan',
						'EUR' => 'EUR - euro_eur',
						'GBP' => 'GBP - british_pound_sterling',
						'INR' => 'INR - indian_rupee',
						'NZD' => 'NZD - new_zealand_dollar',
						'USD' => 'USD - us_dollar'
				),
				'africa' => array (
						'ZAR' => 'ZAR - south_african_rand'
				),
				'americas' => array (
						'BRL' => 'BRL - brazilian_real',
						'CAD' => 'CAD - canadian_dollar',
						'COP' => 'COP - colombia_peso',
						'MXN' => 'MXN - mexican_peso',
						'USD' => 'USD - us_dollar'
				),

				'asia' => array (
						'CNY' => 'CNY - chinese_yuan',
						'HKD' => 'HKD - hong_kong_dollar',
						'IDR' => 'IDR - indonesia_rupiah',
						'INR' => 'INR - indian_rupee',
						'JPY' => 'JPY - japanese_yen',
						'KRW' => 'KRW - south_korean_won',
						'MYR' => 'MYR - malaysian_ringgit',
						'PHP' => 'PHP - philippine_peso',
						'SGD' => 'SGD - singapore_dollar',
						'THB' => 'THB - thai_baht',
						'TWD' => 'TWD - new_taiwan_dollar'
				),

				'middle_east' => array (
						'AED' => 'AED - uae_dirham',
						'ILS' => 'ILS - israeli_new_sheqel',
						'QAR' => 'QAR - qatar_rial',
						'SAR' => 'SAR - saudi_arabia_riyal',
						'TRY' => 'TRY - turkish_lira'
				),
				'europe' => array (
						'CHF' => 'CHF - swiss_franc',
						'CZK' => 'CZK - czech_republic_koruna',
						'DKK' => 'DKK - danish_krone',
						'EUR' => 'EUR - euro_eur',
						'GBP' => 'GBP - british_pound_sterling',
						'HUF' => 'HUF - hungary_forint',
						'NOK' => 'NOK - norwegian_krone',
						'PLN' => 'PLN - polish_zloty',
						'RUB' => 'RUB - russian_ruble',
						'SEK' => 'SEK - swedish_krona',
						'UAH' => 'UAH - ukrainian_hryvnia'
				),
				'oceania' => array (
						'AUD' => 'AUD - australian_dollar',
						'NZD' => 'NZD - new_zealand_dollar'
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
