<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Message\ValidEmail;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MessageBusInterface $bus, UserAuthenticator $authenticator, UserAuthenticatorInterface $userAuthenticator): Response
    {
       $error = $authenticationUtils -> getLastAuthenticationError();
       $lastUsername = $authenticationUtils -> getLastUsername();

       $user = new User();
       $form = $this -> createForm(RegistrationFormType::class, $user);
       $form -> handleRequest($request);

       if ($form -> isSubmitted()) {
          if (!$form->isValid()) {
             $this->addFlash('register-error', 'yes');
          } else {
             $user -> setPassword($userPasswordHasher -> hashPassword($user, $form -> get('plainPassword') -> getData()));

             $entityManager -> persist($user);
             $entityManager -> flush();

             $bus -> dispatch(new ValidEmail($user -> getId()));

             $this -> addFlash('success', 'Vous êtes bien inscrit. N\'oubliez pas de confirmer votre adresse e-mail');
             $userAuthenticator -> authenticateUser($user, $authenticator, $request);
             return $this -> redirectToRoute('home');
          }
       }

       return $this -> render('home/home.html.twig', [
          'title' => 'Home',
          'h1' => 'Home',
          'last_username' => $lastUsername,
          'error' => $error,
          'registrationForm' => $form->createView(),
       ]);

    }

}