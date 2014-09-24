<?php

/*
 * Couchbase connection class
 * @author     K.N. Santosh Hegde
 * @since      28/8/2014
 * @version    1.0
 */
namespace HC\Library;
class Couchbase  {

    private $host = 'http://127.0.1.1';
    private $port = '8091';
    private $bucket = 'default';
    private $user;
    private $password;
    private $indexDisplayLimit;
    private $connPrrsist;   

    public function __construct($bucket = false, $host = false, $port = false, $user = false, $pass= false, $preset = false) {
        
        $this->init($bucket, $host, $port, $user, $pass, $preset);       
    }
    
    private function init($bucket, $host, $port, $user, $pass, $preset) {
        if ('' != $host)
            $this->host = $host;
        
        if ('' != $port)
            $this->port = $port;
        
        if ('' != $user)
            $this->user = $user;
        
        if ('' != $pass)
            $this->password = $pass;
        
        if ('' != $bucket)
            $this->bucket = $bucket;
        
        if ('' != $preset)
            $this->connPrrsist = $preset;                
    }
    
    public function connect() {
        try {
            $this->couchbase = new \Couchbase($this->host, $this->user, $this->password, $this->bucket, $this->connPrrsist);
        } catch (CouchbaseException $ex) {
            echo $ex->getMessage();
        }
    } 

}
