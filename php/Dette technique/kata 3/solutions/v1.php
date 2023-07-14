<?php

class UserManager {
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($userData)
    {
        $user = new User();
        $user->setName($userData['name']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);

        // Validation, hashing du mot de passe, envoi d'email de confirmation, etc.
        
        $this->userRepository->save($user);
    }
}

class UserRepository {
    public function save(User $user)
    {
        // Logique de sauvegarde de l'utilisateur dans la base de données
    }
}

class User {
    // Propriétés et méthodes de l'utilisateur
}





















# Le code non utilisé, tel que la création du profil utilisateur et d'autres fonctionnalités supplémentaires, est supprimé. La méthode registerUser() se concentre uniquement sur les fonctionnalités nécessaires à l'enregistrement d'un utilisateur, conformément au principe YAGNI.
