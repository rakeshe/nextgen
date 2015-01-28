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
        'viewsDir' => 'views/themes/',
        'formsDir' => 'forms/',
        'LanguageDir' => 'ti/language/'
    ),
    'destination' => array(
        'AU' => array(
            array(
                'id' => '1',
                'Rcountrycode' => 'AU',
                'ref' => 'AU',
                'Destination' => 'Australia (including Thursday Island)',
                'isChecked' => false,
                'TIL' => '',
                'TAC' => ''
            ),
            array(
                'id' => '2',
                'Rcountrycode' => 'AU',
                'ref' => 'NZ',
                'Destination' => 'New Zealand, Bali, Fiji, Pacific Islands',
                'isChecked' => false,
                'TIL' => '',
                'TAC' => ''
            ),
            array(
                'id' => '3',
                'Rcountrycode' => 'AU',
                'ref' => 'SG',
                'Destination' => 'Asia (EXCLUDING Russia, Japan, Bali & Indonesia)',
                'isChecked' => false,
            ),
            array(
                'id' => '4',
                'Rcountrycode' => 'AU',
                'ref' => 'RU',
                'Destination' => 'Europe, United Kingdom, Russia',
                'isChecked' => false,
            ),
            array(
                'id' => '5',
                'Rcountrycode' => 'AU',
                'ref' => 'US',
                'Destination' => 'USA, Hawaii, Caribbean, Central & South America, Africa, Japan, Middle East, Indian Ocean and any other destination not listed above.',
                'isChecked' => false,
            )
        ),
        'NZ' => array(
            array(
                'id' => '6',
                'Rcountrycode' => 'NZ',
                'ref' => 'NZ',
                'Destination' => 'New Zealand',
                'isChecked' => false,
            ),
            array(
                'id' => '7',
                'Rcountrycode' => 'NZ',
                'ref' => 'AU',
                'Destination' => 'Australia, Bali, Fiji, Pacific Islands',
                'isChecked' => false,
            ),
            array(
                'id' => '8',
                'Rcountrycode' => 'NZ',
                'ref' => 'SG',
                'Destination' => 'Asia (EXCLUDING Russia, Japan, Bali & Indonesia)',
                'isChecked' => false,
            ),
            array(
                'id' => '9',
                'Rcountrycode' => 'NZ',
                'ref' => 'RU',
                'Destination' => 'Europe, United Kingdom, Russia',
                'isChecked' => false,
            ),
            array(
                'id' => '10',
                'Rcountrycode' => 'NZ',
                'ref' => 'US',
                'Destination' => 'USA, Hawaii, Caribbean, Central & South America, Africa, Japan, Middle East, Indian Ocean and any other destination not listed above.',
                'isChecked' => false,
            )
        ),
        'SG' => array(
            array(
                'id' => '13',
                'Rcountrycode' => 'SG',
                'ref' => 'AU',
                'Destination' => 'Australia, New Zealand, Papua New Guinea, China, Hong Kong, Macau, Japan, Korea (North & South), Taiwan, Palau, Mongolia, Fiji, Pacific Islands, India, Pakistan, Sri Lanka, Bangladesh, Maldives',
                'isChecked' => false,
            ),
            array(
                'id' => '12',
                'Rcountrycode' => 'SG',
                'ref' => 'RU',
                'Destination' => 'United Kingdom, Europe, Middle East, Caribbean, South America, Central America, Africa and any other destination not listed',
                'isChecked' => false,
            ),
            array(
                'id' => '11',
                'Rcountrycode' => 'SG',
                'ref' => 'CA',
                'Destination' => 'USA (INCLUDING Hawaii & Alaska), Canada',
                'isChecked' => false,
            )
        )
    ),
    'regionRisk' => array(
        'AU' => array(
            1 => 'AU',
            2 => 'SG',
            3 => 'NZ',
            4 => 'RU',
            5 => 'US',
        ),
        'NZ' => array(
            1 => 'NZ',
            2 => 'SG',
            3 => 'AU',
            4 => 'RU',
            5 => 'US',
        ),
        'SG' => array(
            2 => 'MY',
            3 => 'AU',
            4 => 'RU',
            5 => 'CA',
        ),
    ),
    'regionCode' => array(
        1 => 'DO',
        2 => 'AS',
        3 => 'PC',
        4 => 'EU',
        5 => 'WW'
    ),
    'searchConfig' => array(
        'stagingGateWay' => array(
//AllianzPricingGateway = "https://uat.magroup-webservice.com/gateway/pricing",
            'AllianzPricingGateway' => "https://www.magroup-webservice.com/gateway/pricing",
            'AllianzPurchasingGatewayForAU' => "https://uat.magroup-online.com/HTC/AU?restart=",
            'AllianzPurchasingGatewayForNZ' => "https://uat.magroup-online.com/HTC/NZ?restart=",
        ),
        'liveGateWay' => array(
            'AllianzPricingGateway' => "http://www.magroup-webservice.com/gateway/pricing",
            'AllianzPurchasingGatewayForAU' => "https://www.magroup-online.com/htc/au?restart=1",
            'AllianzPurchasingGatewayForNZ' => "https://www.magroup-online.com/htc/nz?restart=1",
        ),
        'APIData' => array(
//settng the environment type : live or staging
            'environment' => 'live',
            'securityKey' => 'MJHANOB13551qiekhq',
            'partnerName' => 'HTC',
            'saleOrigin' => 'www.hotelclub.com',
            'travelType' => 'RoundTrip',
        ),
        'countryOfResidence' => array(
            'AU' => 'Australia',
            'NZ' => 'New Zealand',
        ),
        'adult' => array(
            'value' => '1,2,3,4,5'
        ),
        'dependants' => array(
            'value' => '0,1,2,3,4,5'
        )
    )
        ));
