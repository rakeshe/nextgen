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
            $data = file_get_contents( __DIR__ . '/../data/deals.json');
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


}