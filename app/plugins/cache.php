<?php
/**
 *
 * @package    cache.php
 * @author     Rakesh Shrestha
 * @since      4/12/13 7:46 PM
 * @version    1.0
 */
use Phalcon\Cache\Frontend\Data as DataFrontend,
    Phalcon\Cache\Multiple,
    Phalcon\Cache\Backend\Apc as ApcCache,
    Phalcon\Cache\Backend\Memcache as MemcacheCache,
    Phalcon\Cache\Backend\File as FileCache;
class cache extends DataFrontend
{
    const LIFETIME = 604800;
    protected $cache;

    public function __construct(){
    $this->cache = //Backends are registered from the fastest to the slower
    $cache = new Multiple(array(
        new ApcCache($ultraFastFrontend, array(
            "prefix" => 'cache',
        )),
        new MemcacheCache($fastFrontend, array(
            "prefix" => 'cache',
            "host" => "localhost",
            "port" => "11211"
        )),
        new FileCache($slowFrontend, array(
            "prefix" => 'cache',
            "cacheDir" => "../app/cache/"
        ))
    ));
    }
}
/*$ultraFastFrontend = new DataFrontend(array(
    "lifetime" => 3600
));

$fastFrontend = new DataFrontend(array(
    "lifetime" => 86400
));

$slowFrontend = new DataFrontend(array(
    "lifetime" => 604800
));*/

