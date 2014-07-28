<?php
/**
 *
 * @package    language.php
 * @author     Rakesh Shrestha
 * @since      25/11/13 2:04 PM
 * @version    1.0
 */
namespace HC\Language;
class Translation
{
    const DEFAULT_PAGE_LANGUAGE = 'en';

    protected $language;
    protected $messages;

    public function __construct($language)
    {
        $this->language = null === $language ? self::DEFAULT_PAGE_LANGUAGE : $language;
        $this->messages =  $this->getTranslation();
    }

    public function getTranslation()
    {
        $messages = [];
        $languageFile = __DIR__ . '/' . $this->language . ".php";
        $languageFileDefault = __DIR__ . '/' . "en.php";

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