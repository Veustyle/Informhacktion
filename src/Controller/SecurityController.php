<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    #[Route(path: '/connexion', name: 'login')]
//    public function login(AuthenticationUtils $authenticationUtils): Response
//    {
//         if ($this->getUser()) {
//            $this->addFlash('success', 'Vous êtes déjà connecté');
//             return $this->redirectToRoute('home');
//         }
//
//        $error = $authenticationUtils->getLastAuthenticationError();
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        return $this->render('security/login.html.twig', [
//           'title' => 'Connexion',
//           'h1' => 'Connexion',
//           'last_username' => $lastUsername,
//           'error' => $error
//        ]);
//    }

    #[Route(path: '/deconnexion', name: 'logout')]
    public function logout(): void
    {
    }
}
