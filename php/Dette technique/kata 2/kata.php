<?php

class User {
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function sendWelcomeEmail()
    {
        $mailer = new Mailer();
        $message = "Welcome, " . $this->name . "!";
        $mailer->send($this->email, $message);
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
