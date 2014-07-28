<?php

/**
 *
 * @package    SearchBox.php
 * @author     K.N. Santosh Hegde
 * @since      30/4/14
 * @version    1.0
 */
namespace HC\Components;
use Phalcon\Mvc\User\Component;

class SearchBox extends Component
{

    private $serchItems;
    private $filename = 'search-conf.ini';

    public function __construct()
    {
        $this->parseINI();
    }

    public function getAll()
    {
        return $this->serchItems;
    }

    public function getValueByKey($key)
    {
        if (!empty($this->serchItems[$key])) {
            return $this->serchItems[$key];
        }
    }

    public function parseINI()
    {
        $this->serchItems = new \Phalcon\Config\Adapter\Ini(__DIR__ . '/../../apps/ti/config/ini/' . $this->filename);
    }

}
