<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->setUp();
    }
    public function setUp()
    {
        if (getEnv("APP_ENV") == "local") {
            $this->mail->SMTPDebug = 2;
        } else {
            $this->mail->SMTPDebug = "";
        }
        $this->mail->isSMTP();
        $this->mail->Host = getEnv("MAIL_HOST");
        $this->mail->SMTPAuth = true;
        $this->mail->Username = getEnv("EMAIL_USERNAME");
        $this->mail->Password = getEnv("EMAIL_PASSWORD");
        $this->mail->Port = getEnv("SMTP_PORT");
        $this->mail->isHTML(true);
        $this->mail->SingleTo = true;

        $this->mail->From = getEnv("ADMIN_EMAIL");
        $this->mail->FromName = getEnv("APP_NAME");

    }
    public function send($data)
    {
        $this->mail->addAddress($data["to"], $data["to_name"]);
        $this->mail->Subject = $data["subject"];
        $this->mail->Body = makeMail($data["file_name"], $data);

        return $this->mail->send();

    }
}
