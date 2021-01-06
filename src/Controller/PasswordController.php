<?php

namespace App\Controller;

class PasswordController extends Controller {

    public function postPassword() {
    $password = filter_var($_PSOT['password'], FILTER_SANITIZE_STRING);
    $now = new \DateTime();
    $key = bin2hex(openssl_random_pseudo_bytes(256/8)); // 256bit random key
    $e_password = $this->encrypt($password, $key);
    var_dump($e_password);
    //TODO: Insert into DB with uid
    }

    public function getPassword($uid, $key) {

    }
}