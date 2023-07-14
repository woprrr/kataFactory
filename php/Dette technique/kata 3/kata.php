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

        // Code supplémentaire qui n'est pas encore utilisé
        $userProfile = new UserProfile();
        $userProfile->setUserId($user->getId());
        $userProfile->setBio('');
        $userProfile->setAvatar('');

        // Enregistrement du profil utilisateur
        // ...

        // Autres fonctionnalités non utilisées pour l'instant
        // ...
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

class UserProfile {
    // Propriétés et méthodes du profil utilisateur
}





















# Dans cet exemple, la méthode registerUser() de la classe UserManager viole le principe YAGNI en incluant du code supplémentaire qui n'est pas encore utilisé. Plus précisément, la création et l'enregistrement du profil utilisateur (UserProfile) ainsi que d'autres fonctionnalités non utilisées sont ajoutées lors de l'enregistrement d'un utilisateur.
