<?php
/**
 *
 * @package    Menu.php
 * @author     Rakesh Shrestha
 * @since      25/11/13 7:07 PM
 * @version    1.0
 */
class Menu extends Phalcon\Mvc\User\Component
{
    protected $menuItems;
    public static $menuItemsDefault = [
        'top'             => [
            'menu_my_bookings'      => "https://www.hotelclub.com/trips/current",
            'menu_my_club'          => "https://www.hotelclub.com/account/myclub",
            'menu_my_account'       => "https://www.hotelclub.com/account/myprofile",
            'menu_write_a_review'   => "https://www.hotelclub.com/trips/writeReview",
            'menu_customer_service' => "http://faq.hotelclub.com"
        ],
        'languageOptions' => [
            "en" => "English",
            "cs" => "繁體中文 (台灣)",
            "cn" => "简体中文",
            "de" => "Deutsch",
            "es" => "Español",
            "fr" => "Français",
            "hk" => "繁體中文 (香港)",
            "it" => "Italiano",
            "ja" => "日本語",
            "ko" => "한국어",
            "ms" => "Bahasa Melayu",
            "nl" => "Nederlands",
            "pt" => "Português",
            "ru" => "Русский",
            "se" => "Svenska",
            "th" => "ไทย ",
        ],
        'site'            => [
            'menu_home'          => 'http://www.hotelclub.com/',
            'menu_club_benefits' => 'http://www.hotelclub.com/club-benefits'

        ],

    ];

    public function __construct()
    {
        $configFilePath  = __DIR__ . '/../config/menu.ini';
        $this->menuItems = new Phalcon\Config\Adapter\Ini($configFilePath);
    }


    public function getMenuItem($itemKey)
    {
        if (!empty($this->menuItems[$itemKey])) {
            return $this->menuItems[$itemKey];
        }
    }

    /*public function getTopMenu(){
        $return = '';
        foreach($this->menuItems['top'] as $label => $uri){
            $return .= '<li><a rel="nofollow" class="link" href="'. $uri.'">' . $t->_('menu_my_bookings') }}",';
        }

    }
    protected function buildMenu(){

    }*/
}