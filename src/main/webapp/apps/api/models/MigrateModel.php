<?php
/**
 *
 * @package    ClubOffersModel.php
 * @author     Rakesh Shrestha
 * @since      7/10/15 11:22 AM
 * @version    1.0
 */
namespace HC\Api\Models;

class MigrateModel extends ApiModel
{

    public $locale;
    public $currency;

    protected $paramKeys = [ 'locale','currency'];

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param null $offerGroup
     * @return $this
     */
    public function setCurrency($currency = null)
    {
        $this->currency = null === $currency ? $this->getRequest()->get('currency') : $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param null $tier
     * @return $this
     */
    public function setLocale($locale = 'en_au')
    {
        $this->locale = $locale;
        $this->locale = null === $locale ? $this->getRequest()->get('locale') : $locale;
        return $this;
    }


}