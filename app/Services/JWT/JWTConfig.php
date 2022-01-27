<?php

namespace App\Services\JWT;

class JWTConfig {
    private $header = [
        "alg" => "SHA256",
        "typ" => "JWT"
    ];

    private $secret_key = "test";

    public function __get($property) {
        return $this->$property;
    }
}