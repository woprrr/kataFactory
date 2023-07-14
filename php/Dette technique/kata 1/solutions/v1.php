<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\UserType;
use App\Service\UserService;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {
        $users = $this->userService->getAllUsers();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    public function create(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->createUser($user);

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

















































//La validation des données est effectuée en utilisant un formulaire Symfony (UserType). Le formulaire se charge de valider les données d'entrée avant de les utiliser.
//La logique de persistence des entités a été déléguée à un service UserService. La méthode createUser dans ce service est responsable de la persistance de l'entité User.
//L'accès aux données se fait maintenant à travers le service UserService au lieu d'utiliser directement le Repository. Cela rend le code plus modulaire et facilite les tests.
