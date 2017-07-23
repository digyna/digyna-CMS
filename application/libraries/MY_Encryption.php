<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Encryption extends CI_Encryption
{

function encrypt_url($data, array $params = NULL) {
    $result = parent::encrypt($data, $params);

    $result = strtr($result, array('/' => '~'));

    return $result;
}

public function decrypt_url($data, array $params = NULL) {
    $data = strtr($data, array('~' => '/'));

    return parent::decrypt($data, $params);
}

}