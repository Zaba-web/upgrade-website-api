<?php

namespace App\Services\JWT;

use App\Services\JWT\JWTConfig;
use App\Services\JWT\Base64URL;

class JWTVerifier {
    private $config;

    public function __construct() {
        $this->config = new JWTConfig();
    }

    /**
     * Check if token is valid
     * 
     * @param string $token string with token
     * @return bool result
     */
    public function verify($token) {
        $tokenParts = explode('.', $token);

        $unsignedToken = $tokenParts[0] . "." . $tokenParts[1];
        $newSignature = hash_hmac($this->config->header['alg'], $unsignedToken, $this->config->secret_key);

        return $newSignature === $tokenParts[2];
    }
}