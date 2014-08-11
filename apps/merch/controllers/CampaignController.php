<?php
/**
 *
 * @package    Campaign Controller
 * @author     K.N. Santosh Hegde
 * @since      11/8/2014
 * @version    1.0
 */

namespace HC\Merch\Controllers;
class CampaignController extends ControllerBase
{
     public function initialize()
    {        
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();       
    }
    
    public function indexAction() {
        echo '<h1>from index</h1>';
    }
    
    public function cityAction() {
        echo '<h1>from city</h1>';
    }
    
    public function countryAction() {
        echo '<h1>from country</h1>';
    }
    
    public function regionAction() {
        echo '<h1>from region</h1>';
    }
    
}

