<?php

/**
 * for host
 * $this->request->getHttpHost() + salt = hash (dev.nextgen.com + salt = 9c845aebd0c2d4a5532e7cced7aaa1d5)
 *
 * OR
 *
 * $this->request->getClientAddress() + salt = hash (127.0.0.1 + salt = ee8ce6a1d272a6b74168bec07ec41547)
 *
 */
return[
    'dev.nextgen.com' => [
        'salt' => '123456',
        'hash' => '9c845aebd0c2d4a5532e7cced7aaa1d5'
    ]
];