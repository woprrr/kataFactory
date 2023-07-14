<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class UserController extends AbstractController
{
    public function index(Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    public function create(Request $request): Response
    {
        $data = $request->request->all();

        $user = new User()
          ->setName($data['name'])
          ->setEmail($data['email'])
        ;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_index');
    }
}


































//Manque de validation des données d'entrée : Les données reçues dans la méthode create ne sont pas validées avant d'être utilisées. Cela peut conduire à des erreurs si des données incorrectes ou manquantes sont envoyées.
//Mauvaise manipulation de la persistence des entités : La logique de persistence des entités (persist et flush) est directement appelée dans le contrôleur. Il est préférable de déléguer cette tâche à une classe de service ou à un gestionnaire de données dédié.
//Utilisation directe du Repository : Le Repository est utilisé directement dans le contrôleur pour récupérer tous les utilisateurs. Cela peut rendre le code difficile à tester et à maintenir. Il est préférable d'isoler l'accès aux données dans une couche dédiée, par exemple en utilisant un service.
