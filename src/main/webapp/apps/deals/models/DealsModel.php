<?php

/**
 *
 * @package    DealsModel.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Models;

use Phalcon\Exception;

class DealsModel extends \Phalcon\Mvc\Model
{
    const PROMOTIONS_CLUB_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_club:en_AU'; // sale:md5(deals):promo_club:en_AU
    const PROMOTIONS_PM_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_pm:en_AU'; // sale:md5(deals):promo_pm:en_AU


    public function init() {

    }

    public function initBuckets() {

    }

    public function setPageUrl($url) {

    }

    public function getCityDocument() {

        try{
            $data = file_get_contents( __DIR__ . '/../data/city.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getHotels($region, $city) {

        try{
            $cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $dataFile = $cityName.'.json';
            $data = file_exists(__DIR__ .'/../data/'. $dataFile) ?
                file_get_contents(__DIR__ .'/../data/'. $dataFile) :
                file_get_contents( __DIR__ . '/../data/deals.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getUserInfo($memberId) {

        try{
            $data = file_get_contents( __DIR__ . '/../data/loyalty_member.json');
            return $data;
        }catch (\Exception $e) {

        }
    }

    public function getLoyaltyInfo($memberId) {

        try{
            $data = file_get_contents( __DIR__ . '/../data/user-info.json');
            return $data;
        }catch (\Exception $e) {

        }

    }

    public function getClubPromotions() {

        try {

            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get(ORBITZ_ENV . self::PROMOTIONS_CLUB_DOC_NAME);

            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/club-promotion.json')) {
                    return file_get_contents( __DIR__ . '/../data/club-promotion.json');
                }
                return false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function getPMPromotions() {

        try {

            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get(ORBITZ_ENV . self::PROMOTIONS_PM_DOC_NAME);

            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/pm-promotion.json')) {
                    return file_get_contents( __DIR__ . '/../data/pm-promotion.json');
                }
                return false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }


}