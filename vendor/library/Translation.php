<?php
/**
 *
 * @package    Translation.php
 * @author     K.N. Santosh Hegde
 * @since      2/5/14 2:04 PM
 * @version    1.1
 */
namespace HC\Library;
class Translation
{
    protected $language;
    protected $messages;

    public function __construct($language, $message = [])
    {        
        $this->language = $language;
        $this->messages = $message;       
    }
   
    /**
     * Get translation object
     * @return \Phalcon\Translate\Adapter\NativeArray
     * @throws \Phalcon\Exception
     */

    public function getTranslation()
    {
        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $this->messages
        ));
    }
    
    /**
     * 
     * @param type $lang
     * @return void
     */
    public function setLanguage($lang) {
        $this->language = $lang;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

}