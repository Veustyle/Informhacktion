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
use Symfony\Component\Process\Process;


class CronController extends AbstractController
{
    #[Route('/cron', name: 'cron')]
    public function index(): Response
    {

       $consolePath = "../bin/console";


        $command = [
           'php',
           $consolePath,
           'messenger:consume',
           'async',
        ];
        $process = new Process($command);
        
        $process->start();
        $process->wait();
        if ($process->isSuccessful()) {
            return $this->redirectToRoute('home');
        }
       return new Response('probleme');

    }

}