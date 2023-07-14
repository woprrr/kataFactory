<?php

class User {
    private $name;
    private $email;
    private $userRepository;
    
    public function __construct($name, $email, $userRepository)
    {
        $this->name = $name;
        $this->email = $email;
        $this->userRepository = $userRepository;
    }

    public function save()
    {
        // Logique de sauvegarde de l'utilisateur dans la base de données
        $this->userRepository->save($this);
    }

    public function sendWelcomeEmail()
    {
        // Logique d'envoi de l'email de bienvenue
        $message = "Welcome, " . $this->name . "!";
        $mailer = new Mailer();
        $mailer->send($this->email, $message);
    }
}

class UserRepository {
    public function save(User $user)
    {
        // Logique de sauvegarde de l'utilisateur dans la base de données
    }
}

class Mailer {
    public function send($to, $message)
    {
        // Logique d'envoi de l'email
    }
}
