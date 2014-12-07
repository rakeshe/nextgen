<?php

$encData = '0774e8c12a4924650b7';

function OrbitzDecrypt($data, $key=NULL) {
    if ($key == NULL) {
        $ini_array = parse_ini_file("/etc/orbitz/encryption.properties");
        $key = $ini_array['encryption.key'];
    }
    $unhexed_key = pack('H*', $key);
    $unhexed_data = pack('H*', $data);
    $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $unhexed_key, $unhexed_data, MCRYPT_MODE_CBC);
    $trimlen = ord(substr($decrypted, -1));
    return substr($decrypted, 0, -($trimlen));
}

echo OrbitzDecrypt($encData);

