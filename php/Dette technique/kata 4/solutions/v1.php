<?php

class User {
    private $name;
    private $email;
    
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    // Getters et setters

    // ...
}

class UserRepository {
    public function save(User $user)
    {
        // Logique de sauvegarde de l'utilisateur dans la base de données
    }
}

class WelcomeEmailSender {
    public function sendWelcomeEmail(User $user)
    {
        // Logique d'envoi de l'email de bienvenue
        $message = "Welcome, " . $user->getName() . "!";
        $mailer = new Mailer();
        $mailer->send($user->getEmail(), $message);
    }
}

class Mailer {
    public function send($to, $message)
    {
        // Logique d'envoi de l'email
    }
}
