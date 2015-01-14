<?php
/**
 *
 * Global website menu configuration
 * @author     K.N. Santosh Hegde
 * @since      28/7/2014
 * @version    1.0
 */
return new \Phalcon\Config(array(
    'ORBITZ_ENV' => apache_getenv("ORBITZ_ENV"),
    'database' => array(
        'adapter' => '115',
        'host' => '115',
        'username' => '115',
        'password' => '115',
        'dbname' => '115',
    ),
    'couchbase' => array(
//        'host'  => 'hc-rshrestha02.oww.root.lcl',
//        'host'  => '127.0.1.1',
//        'port'  => 8091,
//        'user'  => '',
//        'password' => ''
/**
 * ENSURE THIS IS ENABLED BEFORE COMMITING RELEASE X.Y.Z TO GIT AS FINAL RELEASE
 * IE REMOVE COUCH SETTING ABOVE AND UNCOMMENT SETTINGS BELOW
 *
 */
        'host' => 'cache.qa.orbitz.net',
        'port' => 8006,
        'user' => '',
        'password' => 'hc-cache-qa',
        'bucket' => 'hc-cache'
/**
 * END OF FQA SETTINGS
 */
    ),
    'menuItems' => array(
        'top' => array(
            'menu_my_bookings' => 'https://www.hotelclub.com/trips/current',
            'menu_my_club' => 'https://www.hotelclub.com/account/myclub',
            'menu_my_account' => 'https://www.hotelclub.com/account/myprofile',
            'menu_write_a_review' => 'https://www.hotelclub.com/trips/writeReview',
            'menu_customer_service' => 'http://faq.hotelclub.com'
        ),
        
        'site' => array(
            'menu_home' => 'http://www.hotelclub.com/',
            'menu_club_benefits' => 'http://www.hotelclub.com/club-benefits'
        ),
        'rightSite' => array(
            
        ),
        'account' => array(
            'sign_in' => "https://www.hotelclub.com/account/login",
            //'sign_out' => "https://www.hotelclub.com/account/logout",
            'register' => "https://www.hotelclub.com/account/registration"
        ),
        'deviceLeft' => array(
            'menu_home' => 'http://www.hotelclub.com/',
            'menu_club_benefits' => 'http://www.hotelclub.com/club-benefits',
            'menu_lang_en' => 'English',
            'menu_customer_service' => 'http://faq.hotelclub.com'
        ),
        'deviceRight' => array(
            'menu_my_bookings' => 'https://www.hotelclub.com/trips/current',
            'menu_my_club' => 'https://www.hotelclub.com/account/myclub',
            'menu_my_account' => 'https://www.hotelclub.com/account/myprofile',
            'sign_in' => "https://www.hotelclub.com/account/login",
            'register' => "https://www.hotelclub.com/account/registration"
        )
    )
));
