<?php

namespace App\Services\JWT;

use App\Services\JWT\JWTConfig;
use App\Services\JWT\Base64URL;

class JWTGenerator {
    private $config;

    public function __construct() {
        $this->config = new JWTConfig();
    }

    /**
     * Create new JWT
     * 
     * @param array $_payload array that needs to be encoded
     * @return string new token 
     */
    public function create($_payload) {
        $head = Base64URL::encode(json_encode($this->config->header));
        $payload = Base64URL::encode(json_encode($_payload));

        $unsignedToken = $head . "." . $payload;

        $signature = hash_hmac($this->config->header['alg'], $unsignedToken, $this->config->secret_key);

        $token = $unsignedToken.".".$signature;

        return $token;
    }
}