<?php
/**
 *
 * @package    Menu.php
 * @author     Rakesh Shrestha
 * @since      25/11/13 7:07 PM
 * @version    1.0
 */
class Menu extends Phalcon\Mvc\User\Component
{
    protected $menuItems;

    public function __construct()
    {
        $configFilePath  = __DIR__ . '/../config/menu.ini';
        $this->menuItems = new Phalcon\Config\Adapter\Ini($configFilePath);
    }


    public function getMenuItem($itemKey)
    {
        if (!empty($this->menuItems[$itemKey])) {
            return $this->menuItems[$itemKey];
        }
    }

}