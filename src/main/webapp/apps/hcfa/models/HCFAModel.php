<?php

/**
 *
 * @package    HCFAModule.php
 * @author     K.N. Santosh Hegde
 * @since      29/09/2015
 * @version    1.0
 */

namespace HC\HCFA\Models;

use Phalcon\Exception;

class HCFAModel extends \Phalcon\Mvc\Model
{
    //hcfa:mailchimp:cms
    const DOC_NAME_CMS = 'hcfa:acd1bc21d20c359f8fd6a65107399106:cms';

    //hcfa:mailchimp:config
    const DOC_NAME_CONFIG = 'hcfa:acd1bc21d20c359f8fd6a65107399106:config';

    public function init() {

    }

    /** Get document form couch, if it's not exists, this will load form file system
     *
     * @param $docName string
     * @param bool $decode
     * @return bool|mixed|string
     */

    public function getDocument($docName, $decode = false) {
        try {

            $docName = ORBITZ_ENV . ':' . $docName;

            $fsDocName = strtolower(str_replace(':','_', $docName)) . '.json';

            // Try couch first
            $Couch  = \Phalcon\DI\FactoryDefault::getDefault()['Couch'];
            $data   = $Couch->get($docName);

            // try file system next
            if ($data == false) {
                if(file_exists( __DIR__ . '/../data/'. $fsDocName)) {
                    $data = file_get_contents( __DIR__ . '/../data/' . $fsDocName);
                }
            }
            $data = str_replace("'", "&#39;", $data);

            if ($decode == true) {
                return $data != false ? json_decode($data, true) : false;
            }
            return $data;

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
}