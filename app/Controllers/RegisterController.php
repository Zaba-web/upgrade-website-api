<?php

namespace App\Controllers;

use App\Models\User;

use App\Controllers\Core\Controller;
use App\Controllers\AccountActivationController;
use App\Services\Email\EmailSender;
use App\Services\Response\JSONResponse;

use App\Services\Validation\Validator;

use App\Services\Validation\Rules\MinLength;
use App\Services\Validation\Rules\MaxLength;
use App\Services\Validation\Rules\SameAs;

class RegisterController implements Controller {
    private $Model;
    private $accountActivation;
    private $mailSender;
    
    private $email = '';
    private $name = '';
    private $password = '';
    private $password_re = '';

    public function __construct() {
        $this->Model = new User();
        $this->accountActivation = new AccountActivationController();
        $this->mailSender = new EmailSender();
    }

    public function create() {
        $this->fetchRegisterData($_POST);

        $validationResult = Validator::Validate($this->getValidationRules($this->email, $this->name, $this->password, $this->password_re));
    
        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $user = $this->createModel();
        $userCreated = $this->Model->create($user);
        
        if($userCreated) {
            $this->formatActivationData();
        }

        JSONResponse::POSTResponse($userCreated);
    }

    public function confirm($hash) {
        $activationData = $this->accountActivation->getByHash($hash)[0];

        if(!$activationData) {
            return JSONResponse::message(404, ["message" => "Некоректне посилання"]);
        }

        $userId = $activationData['user_id'];

        $user = $this->Model->getById($userId)[0];

        $this->fetchRegisterData($user);
        $newUserModel = $this->createModel();
        $newUserModel['active'] = 1;

        if(!$this->Model->updateById($userId, $newUserModel)) {
            return JSONResponse::message(404, ["message" => "Не вдалося активувати профіль"]);
        }

        $this->accountActivation->delete($activationData['id']);

        return JSONResponse::DefaultSuccessResponse(["message" => "Профіль активовано"]);
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

    private function fetchRegisterData($source) {
        $this->email = $source['email'];
        $this->name = $source['name'];
        $this->password = $source['password'];
        $this->password_re = $source['password_re'];
    }

    private function createModel() {
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        return $this->Model->getModel([
            1, // access level
            0, // is account activated
            $this->name,
            $this->email, 
            $hashed_password
        ]);
    }

    private function formatActivationData() {
        $hash = md5($this->email . $this->password);

        $lastUserId = $this->Model->getLastUserId();
        $confirmationCreated = $this->accountActivation->create($lastUserId, $hash);

        if($confirmationCreated) {
            $this->mailSender->send(
                "Confirmation | Upgrade", 
                "Доброго дня, <b>" . $this->name . "</b>! <br> <p>Дякуємо вам за реєстрацію. Для того, щоб завершити процес, підтвердіть адресу електронної пошти, перейшовши за <a href='http://api.upgrade/confirm/" . $hash . "'> посиланням.</p>", 
                $this->email
            );
        }
    }
}