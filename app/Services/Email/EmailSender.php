<?php

namespace App\Services\Email;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/phpmailer/phpmailer/src/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/phpmailer/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailSender {
    private $mail = null;

    public function __construct() {
        $this->mail = new PHPMailer();

        $this->mail->isSMTP();

        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = "true";
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = "587";

        $this->mail->Username = "";
        $this->mail->Password = "";
    }

    public function send($subject, $body, $to, $from = 'upgrade.ic.bot@gmail.com', $isHTML = true) {
        $result = false;

        $this->mail->isHTML($isHTML);

        $this->mail->Subject = $subject;
        $this->mail->setFrom($from);
        $this->mail->Body = $body;
        $this->mail->addAddress($to);
        
        if($this->mail->send()) {
            $result = true;
        }
        
        return $result;
    }
}