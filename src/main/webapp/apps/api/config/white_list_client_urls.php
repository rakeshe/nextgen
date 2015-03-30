<?php

/**
 * for host
 * $this->request->getHttpHost() + $this->config->secretKey->salt = hash (dev.nextgen.com + salt = 9c845aebd0c2d4a5532e7cced7aaa1d5)
 *
 * OR
 *
 * $this->request->getClientAddress() + $this->config->secretKey->salt = hash (127.0.0.1 + salt = ee8ce6a1d272a6b74168bec07ec41547)
 *
 */
return [
    'dev.nextgen.com' => '9c845aebd0c2d4a5532e7cced7aaa1d5',
    'nextgen-release' => '9c845aebd0c2d4a5532e7cced7aaa1d5',

];