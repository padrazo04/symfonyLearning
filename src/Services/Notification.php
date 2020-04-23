<?php

namespace App\Services;

class Notification {

    private $email;

    public function __construct($email, FileUploader $fileUploader)
    {
        dump($fileUploader); die;
        $this->email = $email;
    }

    public function sendNotification() {
        $this->email = 2;
        return $this->email;
    }
}