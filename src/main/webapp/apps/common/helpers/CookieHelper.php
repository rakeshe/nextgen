<?php
/**
 * Because Phalcon\Http\Response\Cookies() sets shared domain cookies as httponly
 * which js cannot access
 * @package    CookieHelp.php
 * @author     Rakesh Shrestha
 * @since      30/10/15 11:47 AM
 * @version    1.0
 */
namespace HC\Common\Helpers;

class CookieHelper extends \Phalcon\Http\Cookie
{

    public static function set($cookieName, $cookieValue){
        if(null !== $cookieName){
            $cookie = new \Phalcon\Http\Cookie($cookieName);
            $cookie->setHttpOnly(false);
            $cookie->setValue($cookieValue);
            $cookie->send();
        }

    }

}

 