<?php
/**
 *
 * @package    Page.php
 * @author     Rakesh Shrestha
 * @since      27/11/13 5:17 PM
 * @version    1.0
 * @Updated	   Ravi
 */
namespace HC\Nextgen\Models;
class Page extends \Phalcon\Mvc\Model
{
    protected $dataFilePath;
    protected $data;
    protected $languageCode = 'en';
    protected $campaignName;
    protected $menuTabMain;
    protected $menuTabSub;

    public function getData()
    {
        if (null === $this->data) {
            $this->loadDataFile();
        }
        return $this->data;
    }

    protected function loadDataFile()
    { 
        $dataPage           = [];
        $dataHotels         = [];
        $this->dataFilePath = __DIR__ . '../../../../data/cache/campaign_data_' . $this->languageCode . '.php';
        if (file_exists($this->dataFilePath)) {
            require $this->dataFilePath;
            $this->data              = array_merge($dataPage, ['hotels' => $dataHotels]);
            $this->data['activeTab'] = $this->getCurrentTab();
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
