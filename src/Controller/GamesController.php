<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GamesController extends AbstractController
{
    #[Route('/games', name: 'games')]
    public function index(): Response
    {
        return $this->render('games/games.html.twig', [
            'title' => 'Games',
            'h1' => 'Games',
        ]);
    }

   #[Route('/pacman', name: 'pacman')]
   public function pacman(): Response
   {
      return $this->render('games/pacman.html.twig', [
         'title' => 'Pacman',
         'h1' => 'Pacman'
      ]);
   }

   #[Route('/mmorpg', name: 'mmorpg')]
   public function mmorpg(): Response
   {
      return $this->render('games/mmorpg.html.twig', [
         'title' => 'Mmorpg',
         'h1' => 'Mmorpg'
      ]);
   }

   #[Route('/brickbreaker', name: 'brickbreaker')]
   public function brickbreaker(): Response
   {
      return $this->render('games/brickbreaker.html.twig', [
         'title' => 'Brickbreaker',
         'h1' => 'Brickbreaker'
      ]);
   }
}
