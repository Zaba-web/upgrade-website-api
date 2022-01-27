<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\Core\Controller;
use App\Services\Response\JSONResponse;

use App\Services\JWT\JWTGenerator;
use App\Services\JWT\JWTDecoder;

class AuthController implements Controller {
    private $Model;

    public function __construct() {
        $this->Model = new User();
    }

    public function authenticate() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->Model->getUser($email, $password);

        if(!$user) {
            return JSONResponse::message(401, [
                "message" => "Не вдалося увійти. Перевірте правильність введених даних та переконайтесь, що підтвердили свій профіль через Email"
            ]);
        }

        $dataToSend = [
            "name" => $user['name'],
            "email" => $user['email'],
            "access_level" => $user['access_level']
        ];

        $jwtGen = new JWTGenerator();
        $JWT = $jwtGen->create($dataToSend);

        return JSONResponse::message(202, [
            "token" => $JWT
        ]);
    }

    public function authorize() {
        $headers = apache_request_headers();

        if(!$headers["Authorization"]) {
            return false;
        }
        
        $JWT = explode(" ", $headers['Authorization'])[1];

        $tokenData = JWTDecoder::decode($JWT);

        if(!$tokenData) {
           false;
        }

        $userData = json_decode($tokenData['payload']);

        return $userData->access_level;
    }
}