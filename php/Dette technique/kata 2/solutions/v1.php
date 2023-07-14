<?php

class User {
    private $name;
    private $email;
    private $mailer;

    public function __construct($name, $email, Mailer $mailer)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mailer = $mailer;
    }

    public function sendWelcomeEmail()
    {
        $message = "Welcome, " . $this->name . "!";
        $this->mailer->send($this->email, $message);
    }
}

class Mailer {
    public function send($to, $message)
    {
        // Logique d'envoi de l'email
        echo "Sending email to: $to\n";
        echo "Message: $message\n";
    }
}
