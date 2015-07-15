<?php
/**
 *
 * Global website menu configuration
 * @author     K.N. Santosh Hegde
 * @since      28/7/2014
 * @version    1.0
 */
function getCouchConfigs()
{
    switch (apache_getenv("ORBITZ_ENV")) {
        case 'dev':
            $couchConfig = [
                'host'     => '127.0.1.1',
                'port'     => 8091,
                'user'     => '',
                'password' => '',
                'bucket' => 'hc-cache'
            ];
            break;
        case 'fqa1':
            $couchConfig = [
                'host' => 'cache.qa.orbitz.net',
                'port' => 8006,
                'user' => '',
                'password' => 'hc-cache-qa',
                'bucket' => 'hc-cache'
            ];
            break;

        case 'production':
            $couchConfig = [
                'host' => 'cache-wm.prod.orbitz.net',
                'port' => 8006,
                'user' => '',
                'password' => 'hc-cache-prod2',
                'bucket' => 'hc-cache'
            ];
            break;
	default: $couchConfig = [
                'host'     => '127.0.1.1',
                'port'     => 8091,
                'user'     => '',
                'password' => '',
                'bucket' => 'hc-cache'
            ];
            break;
    }
    return $couchConfig;
}
function getMySqlConfigs()
{
    $config = null;
    switch (apache_getenv("ORBITZ_ENV")) {
        case 'dev':
            $config = [
                'adapter' => 'Mysql',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'dbname' => 'deals'
            ];
            break;
        case 'fqa1':
            $config = [
                'adapter' => 'Mysql',
                'host' => 'hcphpmsql01.qa1.orbitz.net',
                'username' => 'htcn_service',
                'password' => 'htcn_service@123',
                'dbname' => 'ht_cn'
            ];
            break;
        case 'production':
            $config = [
                'adapter' => 'Mysql',
                'host' => 'hcphpmsql01.qa1.orbitz.net',
                'username' => 'htcn_service',
                'password' => 'htcn_service@123',
                'dbname' => 'ht_cn'
            ];
            break;
    }
    return $config;
}

return new \Phalcon\Config(array(
    'ORBITZ_ENV' => apache_getenv("ORBITZ_ENV"),
    'couchbase' => getCouchConfigs(),
    'database' => getMySqlConfigs(),

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
