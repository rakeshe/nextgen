<?php
/**
 * @author     Rakesh Shrestha
 * @package    Hotel
 * @since      3/12/13 9:29 AM
 * @version    1.0
 */
 
class Hotel extends Phalcon\Mvc\Model
{
    protected $id;
    protected $name;
    protected $location;
    protected $stars;
    protected $img = [];
    protected $href;
    protected $country;
    protected $city;
    protected $promoOffer;
    protected $memberOffer;
    protected $conditons;
    protected $discountPercent;
    protected $discountAmount;
    protected $promoCode;
    protected $promoAmount;



    /** Abstract implementation required for this class */
    public function getConnectionService()
    {

    }

    public function setForceExists($bool = true)
    {

    }

    public function dumpResult($var, $foo)
    {

    }

    public function getConnection()
    {

    }

}
