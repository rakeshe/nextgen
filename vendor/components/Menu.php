<?php

/**
 *
 * @package    SearchBox.php
 * @author     K.N. Santosh Hegde
 * @since      5/5/14
 * @version    1.0
 */
namespace HC\Components;
use Phalcon\Mvc\User\Component;

class Menu extends Component
{

    private $items;
    private $filename = 'menu-conf.ini';

    public function __construct()
    {
        $this->parseINI();
    }

    public function getAll()
    {
        return $this->items;
    }

    public function getItemeByKey($key)
    {
        if (!empty($this->items[$key])) {
            return $this->items[$key];
        }
    }

    public function parseINI()
    {
        $this->items = new \Phalcon\Config\Adapter\Ini(__DIR__ . '/../../apps/ti/config/ini/' . $this->filename);
    }

}
