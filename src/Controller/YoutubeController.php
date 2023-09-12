<?php

namespace App\Controller;

use App\Entity\Youtube;
use App\Repository\YoutubeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    #[Route('/videos', name: 'youtube')]
    public function index(YoutubeRepository $repository): Response
    {
        $videos = $repository->findAll();
        return $this->render('youtube/index.html.twig', [
            'title' => 'Videos',
            'h1' => 'Videos',
           'videos' => $videos
        ]);
    }

   #[Route('/videos/{id}', name: 'youtube.show')]
   public function show (Youtube $youtube): Response
   {
      return $this->render('youtube/show.html.twig', [
         'title' => 'Video ' . $youtube->getDescription(),
         'h1' => 'Videos ' . $youtube->getDescription(),
         'video' => $youtube
      ]);
   }
}
