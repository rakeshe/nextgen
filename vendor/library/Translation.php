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
    const DEFAULT_PAGE_LANGUAGE = 'en';

    protected $language;
    protected $messages;
    protected $filePath;

    public function __construct($language = false, $filePath = false)
    {
        if ($filePath == false) {
            throw new \Phalcon\Exception('Please specify language file');
        }
        $this->filePath = $filePath;
        $this->language = null === $language ? self::DEFAULT_PAGE_LANGUAGE : $language;       
    }
    
    /**
     * Set language path
     * @param string $path
     */    
    public function setPath($path) {
        $this->filePath = $path;
    }
    
    /**
     * Get translation object
     * @return \Phalcon\Translate\Adapter\NativeArray
     * @throws \Phalcon\Exception
     */

    public function getTranslation()
    {
        $messages = [];
        $languageFile = __DIR__. '/../../apps/'. $this->filePath . $this->language . '.php';        
        //Check if we have a translation file for that lang
        if (file_exists($languageFile)) {//Check if we have a translation file for that lang
            require $languageFile;
        } else {
           throw new \Phalcon\Exception('Language file not found');
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

}