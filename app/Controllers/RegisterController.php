<?php

namespace App\Controllers;

use App\Models\User;

use App\Controllers\Core\Controller;
use App\Services\Response\JSONResponse;

use App\Services\Validation\Validator;

use App\Services\Validation\Rules\MinLength;
use App\Services\Validation\Rules\MaxLength;
use App\Services\Validation\Rules\SameAs;

class RegisterController implements Controller {
    public function __construct() {
        $this->Model = new User();
    }

    public function create() {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password_re = $_POST['password_re'];

        $validationResult = Validator::Validate($this->getValidationRules($email, $name, $password, $password_re));
    
        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $user = $this->Model->getModel([0, 0, $name, $email, $hashed_password]);

        $result = $this->Model->create($user);

        JSONResponse::POSTResponse($result);
    }

    private function getValidationRules($email, $name, $password, $password_re) {
        return [
            (new MinLength($email, "E-mail повинен містити принаймні 4 символи"))->validate(4),
            (new MaxLength($email, "E-mail повинен містити не більше ніж 255 символів"))->validate(255),

            (new MinLength($name, "Ім'я повинно містити принаймні 5 символів"))->validate(5),
            (new MaxLength($name, "Ім'я повинно містити не більше ніж 255 символів"))->validate(255),

            (new MinLength($password, "Пароль повинен містити принаймні 8 символів"))->validate(8),
            (new MinLength($password, "Пароль повинен містити не більше 255 символів"))->validate(8),
            (new SameAs($password, "Пароль та підтвредження паролю не співпадають"))->validate($password_re),
        ];
    }
}