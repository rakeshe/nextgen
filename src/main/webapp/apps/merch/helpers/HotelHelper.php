<?php
/**
 *
 * @author     Rakesh Shrestha
 * @since      14/08/14 9:27 AM
 * @version    1.0
 */
namespace HC\Merch\Helpers;

/**
 * Class HotelHelper
 *
 * @package HC\Merch\Helpers
 */
class HotelHelper extends \Phalcon\Tag
{
    /**
     * Define uri for cached content at Orbitz Global Platform
     */
    const ORBITZ_HOTEL_CONTENT_URI = 'http://www.tnetnoc.com/hotelimages/';
    
    /**
     * Define uri for cached site images at Orbitz Global Platform
     */
    const ORBITZ_HOTEL_SITE_IMAGES_URI = 'http://www.tnetnoc.com/siteImages/';
    /**
     * Define uri for cache content at HotelClub
     */
    const CLASSIC_HOTEL_CONTENT_URI = 'http://www.hotelclub.com/ad-unit/promodeals/images/';
    /**
     * Define unique content folder used in image uri
     */
    const ORBITZ_HOTEL_FOLDER_ID = '2631759';

    
    static public function getStarUri($star = 5) {
        return self::ORBITZ_HOTEL_SITE_IMAGES_URI .'ORB/icons/stars/star' .$star. '/medium/star' .$star. '-1.png';
    }

    /**
     * @param $oneg
     * @param $name
     * @return string
     */
    static public function getGPHotelImageUri($oneg, $name)
    {
        $hotelName = str_replace(' ', '-', $name);
        $uri       = self::ORBITZ_HOTEL_CONTENT_URI . substr($oneg, -3) . '/' . $oneg . '/'
            . self::ORBITZ_HOTEL_CONTENT_URI . '-' . $hotelName . '-Hotel-Exterior-1.jpg';
        return $uri;
    }

    /**
     * @param $oneg
     * @param $name
     * @return string
     */
    static public function getGPHotelImage($oneg, $name)
    {
        return self::image(self::getGPHotelImageUri($oneg, $name));
    }


    /**
     * @param $oneg
     * @return string
     */
    static public function getClassicHotelImageUri($oneg)
    {
        $uri = self::CLASSIC_HOTEL_CONTENT_URI . 'mp_v1_' . $oneg . '.jpg';
        return $uri;
    }

    /**
     * @param $oneg
     * @return string
     */
    static public function getClassicHotelImage($oneg)
    {
        return self::image(self::getClassicHotelImageUri($oneg));
    }


    /**
     * @param String $oneg
     * @return bool
     */
    static public function getBookingpath(String $oneg){

        return true;


    }
}