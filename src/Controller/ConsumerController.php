<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsumerController extends AbstractController
{
    #[Route('/consumer', name: 'app_consumer')]
    public function index(): Response
    {
       $consolePath = $this->getParameter('kernel.project_dir') . '/bin/console';

       // Commande à exécuter
       $command = [
          'php',
          $consolePath,
          'messenger:consume',
          'async'
       ];

       $process = new Process($command);
       $process->start();
       $process->wait();

       if (!$process->isSuccessful()) {
          $this->addFlash('success', 'Bus Consumer');
       } else {
          $this->addFlash('error', 'Probleme dans la consommation des messages');
       }

       return $this->redirectToRoute('home');
    }
}
