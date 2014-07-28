<?php
/**
 *
 * @package    Translation.php
 * @author     K.N. Santosh Hegde
 * @since      2/5/14 2:04 PM
 * @version    1.0
 */
namespace HC\Library;
class Translation
{
    const DEFAULT_PAGE_LANGUAGE = 'en';

    protected $language;
    protected $messages;

    public function __construct($language = false)
    {
        $this->language = null === $language ? self::DEFAULT_PAGE_LANGUAGE : $language;
        $this->messages =  $this->getTranslation();
    }

    public function getTranslation()
    {
        $messages = [];
        $languageFile = APPLICATION_PATH . '/language/' . $this->language . ".php";
        $languageFileDefault = APPLICATION_PATH . '/language/' . "en.php";

        //Check if we have a translation file for that lang
        if (file_exists($languageFile)) {
            require $languageFile;
        } else {
            // fallback to  default language
            require $languageFileDefault;
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
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

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

}