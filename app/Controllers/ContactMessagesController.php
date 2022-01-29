<?php

namespace App\Controllers;

use App\Services\Email\EmailSender;
use App\Services\Response\JSONResponse;

class ContactMessagesController {
    static public function send() {
        if(!$_POST['name'] || !$_POST['number'] || $_POST['message']) {
            return JSONResponse::message(204, false);
        }

        $sender = new EmailSender();
        $result = $sender->send("Нове повідомлення", "Ім'я: ". $_POST['name'] . "<br>Номер телефону:". $_POST['number'] . "<br>Повідомлення: " . $_POST['message'] ,"upgrade.ic.bot@gmail.com");
        
        if($result) {
            return JSONResponse::POSTResponse($result);
        }

        return JSONResponse::message(204, false);
    }
}