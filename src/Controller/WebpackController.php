<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebpackController extends AbstractController
{
    #[Route('/webpack', name: 'webpack')]
    public function index(): Response
    {
        return $this->render('webpack/webpack.html.twig', [
            'title' => 'WebpackController',
            'h1' => 'WebpackController',
        ]);
    }

   #[Route('/htmx', name: 'htmx')]
   public function htmx(): Response
   {
      return $this->render('webpack/htmx.html.twig', [
         'title' => 'htmx',
         'h1' => 'htmx',
      ]);
   }
}
