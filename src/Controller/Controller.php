<?php

namespace App\Controller;

class Controller {
    protected $container;
    const ENCRYPT_METHOD = 'aes-256-cbc';

    public function __construct($container) {
        $this->container = $container;
    }

    protected function encrypt(string $toEncrypt, string $secret): string {
        $saltLength = openssl_cipher_iv_length(self::ENCRYPT_METHOD);
        $salt = openssl_random_pseudo_bytes($saltLength);
        $encryptedString = openssl_encrypt($toEncrypt, self::ENCRYPT_METHOD, $secret, 0, $salt);
        $saltedAndEncrypted = $salt . $encryptedString;
        return $saltedAndEncrypted;
    }

    protected function decrypt(string $toDecrypt, string $secret): string {
        $saltLength = openssl_cipher_iv_length(self::ENCRYPT_METHOD);
        $unsaltedString = substr($toDecrypt, $saltLength);
        $initializationVector = substr($toDecrypt, 0, $saltLength);
        $decryptedString = openssl_decrypt($unsaltedString, self::ENCRYPT_METHOD, $secret, 0, $initializationVector);
        $cleanedString = rtrim($decryptedString, "\0");
        return $cleanedString;
    }
}