<?php
/**
 *
 * @package    Page.php
 * @author     Rakesh Shrestha
 * @since      27/11/13 5:17 PM
 * @version    1.0
 * @Updated	   Ravi
 */
namespace HC\Merch\Models;
class Page extends \Phalcon\Mvc\Model
{
    protected $campaignFilePath;
    protected $bannerFilePath;
    protected $hotelFilePath;
    protected $data;
    protected $languageCode = 'en_AU';
    protected $region = 'Northeast-Asia';
    protected $campaignName;
    protected $menuTabMain;
    protected $menuTabSub;

    public function getData()
    {
        if (null === $this->data) {
            $this->data['hotels'] = $this->loadCampaignData();
            $banner = $this->loadBannerData();
            $this->data['banners'] = $banner[$this->region];
            $this->data['activeTab'] = $this->getCurrentTab(); //get current tab            
        }
        return $this->data;
    }

    protected function loadCampaignData()
    { 
        $this->campaignFilePath = __DIR__ . '../../../../data/cache/' . $this->languageCode. '_campaign_data.json';
        if (file_exists($this->campaignFilePath)) {
            return json_decode(file_get_contents($this->campaignFilePath), TRUE);
        }
    }
    
    protected function loadBannerData() {
        $this->bannerFilePath = __DIR__ . '../../../../data/cache/' . $this->languageCode. '_banner_data.json';
        if (file_exists($this->bannerFilePath)) {
            return json_decode(file_get_contents($this->bannerFilePath), TRUE);
        }
    }
    
    protected function loadHotelData() {
        $this->hotelFilePath = __DIR__ . '../../../../data/cache/' . $this->languageCode. '_deals_data.json';
        if (file_exists($this->hotelFilePath)) {
            return json_decode(file_get_contents($this->hotelFilePath), TRUE);
        }
    }

    protected function getCurrentTab()
		{
		 if (!(empty($this->data['tabs']))) {
			if ($this->menuTabMain === null && $this->menuTabSub === null) {
			 return "Australia";
			}
			if ($this->menuTabSub == null && !empty($this->menuTabMain)) {
			return $this->menuTabMain;
			}
			if ($this->menuTabSub != null && !empty($this->menuTabSub)) {
			return $this->menuTabSub;
			}
			//return $this->menuTabSub;
			}
		}
    /* @todo refactor this logic 
    protected function getCurrentTab()
    { //echo "<pre>"; print_r($this->menuTabSub);
        if (!(empty($this->data['tabs']))) {
            if ($this->menuTabMain === null && $this->menuTabSub === null) {
                return $this->menuTabMain;
            }
            if ($this->menuTabSub === null && !empty($this->data['tabs'][$this->menuTabMain])) {
               // return $this->data['tabs'][$this->menuTabMain];
			   return $this->menuTabMain;
            }
            if ($this->menuTabSub !== null && !empty($this->data['tabs'][$this->menuTabSub])) {
                //return $this->data['tabs'][$this->menuTabSub];
				 return $this->menuTabSub;
				 
            }
        }
    }
*/
    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;
        return $this;
    }

    /**
     * @param mixed $campaignName
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;
        return $this;
    }

    /**
     * @param mixed $menuTabMain
     */
    public function setMenuTabMain($menuTabMain)
    {
        $this->menuTabMain = $menuTabMain;
        return $this;
    }

    /**
     * @param mixed $menuTabSub
     */
    public function setMenuTabSub($menuTabSub)
    {
        $this->menuTabSub = $menuTabSub;
        return $this;
    }


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
