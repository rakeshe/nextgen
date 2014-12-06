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

    public function getCardTranslation()
    {
        return json_encode(
            [
                'book'                        => $this->getTranslation()->offsetGet('book'),
                'close'                       => $this->getTranslation()->offsetGet('close'),
                'check_rates'                 => $this->getTranslation()->offsetGet('check_rates'),
                'day_names'                   => explode(',', $this->getTranslation()->offsetGet('day_names')),
                'day_names_min'               => explode(',', $this->getTranslation()->offsetGet('day_names_min')),
                'month_names'                 => $this->getTranslation()->offsetGet('month_names'),
                'promo_pc_off_template'       => $this->getTranslation()->offsetGet('promo_pc_off_template'),
                'search'                      => $this->getTranslation()->offsetGet('search'),
                'select'                      => $this->getTranslation()->offsetGet('select'),
                'find'                      => $this->getTranslation()->offsetGet('find'),
                'today'                       => $this->getTranslation()->offsetGet('today'),
                'mem_extras'                  => $this->getTranslation()->offsetGet('mem_extras'),
                'mem_inactive_line1'          => $this->getTranslation()->offsetGet('mem_inactive_line1'),
                'mem_inactive_line2'          => $this->getTranslation()->offsetGet('mem_inactive_line2'),
                'save'                        => $this->getTranslation()->offsetGet('save'),
                'show-more-deals'             => $this->getTranslation()->offsetGet('show_more_deals'),
                'members_only'                => $this->getTranslation()->offsetGet('members_only'),
                'americas_view'       => $this->getTranslation()->offsetGet('back_to_americas_view'),
                'europe_&_uae_view'    => $this->getTranslation()->offsetGet('back_to_europe__uae_view'),
                'northeast_asia_view' => $this->getTranslation()->offsetGet('back_to_northeast_asia_view'),
                'pacfic_view'         => $this->getTranslation()->offsetGet('back_to_pacfic_view'),
                'southeast_asia_view' => $this->getTranslation()->offsetGet('back_to_southeast_asia_view'),
                'world_view'          => $this->getTranslation()->offsetGet('back_to_world_view'),
                'choose_your_dates'           => $this->getTranslation()->offsetGet('choose_your_dates'),
            ]
        );

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