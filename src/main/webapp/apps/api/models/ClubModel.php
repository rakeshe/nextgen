<?php
/**
 *
 * @package    ClubOffersModel.php
 * @author     Rakesh Shrestha
 * @since      7/10/15 11:22 AM
 * @version    1.0
 */
namespace HC\Api\Models;

class ClubModel extends ApiModel
{

    public $tier;
    public $offerGroup;

    protected $paramKeys = [ 'tier','offerGroup'];

    /**
     * @return mixed
     */
    public function getOfferGroup()
    {
        return $this->offerGroup;
    }

    /**
     * @param null $offerGroup
     * @return $this
     */
    public function setOfferGroup($offerGroup = null)
    {
        $this->offerGroup = null === $offerGroup ? $this->getRequest()->get('group') : $offerGroup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTier()
    {
        return $this->tier;
    }

    /**
     * @param null $tier
     * @return $this
     */
    public function setTier($tier = null)
    {
        $this->tier = $tier;
        $this->tier = null === $tier ? $this->getRequest()->get('tier') : $tier;
        return $this;
    }


}