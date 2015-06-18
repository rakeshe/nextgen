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
    const PROMOTIONS_CLUB_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_club'; // sale:md5(deals):promo_club
    const PROMOTIONS_PM_DOC_NAME = 'sale:6c996181cb66b09cf475386ff06ad9e2:promo_pm'; // sale:md5(deals):promo_pm
    const DOC_NAME_FOOTER_SEO_LINKS = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_seo';
    const DOC_NAME_FOOTER_ABOUT = 'sale:6c996181cb66b09cf475386ff06ad9e2:footer_about';

    const DEFAULT_REGION='Australia, New Zealand Pacific';
    const DEFAULT_CITY = 'Sydney';
    const DEFAULT_TRAVEL_PERIOD = '30-days';

    protected $locale = 'en_AU';

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

    public function getHotels($region=self::DEFAULT_REGION, $city=self::DEFAULT_CITY, $when = self::DEFAULT_TRAVEL_PERIOD) {

        try{
            /*// format: production:sale:md5(deals/Sydney/30-days):en_AU
            $cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $couchDocName = ORBITZ_ENV . ':sale:'. md5('deals/'. $cityName .'/'. $when) . ':' . $this->getLocale();
            $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }*/
            $cityName = strtolower(str_replace([' ',',','\''], '_', $city));
            $dataFile = $cityName.'.json';
            $data = file_exists(__DIR__ .'/../data/'. $dataFile) ?
                file_get_contents(__DIR__ .'/../data/'. $dataFile) :
                '{}';
            //file_get_contents( __DIR__ . '/../data/deals.json');
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

    /**
     * Given document name, retrieve from Couch first, then file system if fails
     * @param $documentName
     * @return bool|string
     */
    public function getCmsDocument($documentName, $decode = false) {

        try {
            $couchDocName = ORBITZ_ENV . ':'. $documentName . ':'. $this->getLocale();
            $fsDocName = strtolower(str_replace(':','_', $couchDocName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($couchDocName);

            // try file system next
            if ($data == false) {

                if(file_exists( __DIR__ . '/../data/' . $fsDocName)) {
                    $data =  file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }
            return $decode ? json_decode($data) : $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }


}