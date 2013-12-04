<?php
/**
 *
 * @package    test.php
 * @author     Rakesh Shrestha
 * @since      4/12/13 8:31 AM
 * @version    1.0
 */
// Config Settings
define("COUCHBASE_HOSTS", "127.0.0.1");
define("COUCHBASE_BUCKET", "beer-sample");
define("COUCHBASE_PASSWORD", "");
define("COUCHBASE_CONN_PERSIST", true);
define("INDEX_DISPLAY_LIMIT", 20);

// adjust these parameters to match your installation
$cb = new Couchbase(COUCHBASE_HOSTS, "beer-sample", COUCHBASE_PASSWORD, COUCHBASE_BUCKET, COUCHBASE_CONN_PERSIST);

$doc = $cb->get(
    "21st_amendment_brewery_cafe"
);

if ($doc) {
    // Decode the JSON string into a PHP array
    $doc     = json_decode($doc, true);
    print_r($doc);

}