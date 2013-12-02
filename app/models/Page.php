<?php
/**
 *
 * @package    Page.php
 * @author     Rakesh Shrestha
 * @since      27/11/13 5:17 PM
 * @version    1.0
 */
class Page extends Phalcon\Mvc\Model
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
        $this->dataFilePath = __DIR__ . '/../../cache/campaign_data_' . $this->languageCode . '.php';
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

            } else {
                return $this->menuTabSub === null ? $this->data['tabs'][$this->menuTabMain] : $this->data['tabs'][$this->menuTabMain][$this->menuTabSub];
            }
        }
    }

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