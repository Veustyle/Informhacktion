<?php

namespace App\Controller;

use App\Entity\Youtube;
use App\Repository\YoutubeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    #[Route('/videos', name: 'youtube')]
    public function index(YoutubeRepository $repository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $videos = $repository->findPaginated($offset);

        return $this->render('youtube/index.html.twig', [
            'title' => 'Videos',
            'h1' => 'Videos',
            'videos' => $videos,
            'previous' => $offset - YoutubeRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($videos), $offset + YoutubeRepository::PAGINATOR_PER_PAGE)
        ]);
    }

   #[Route('/videos/{id}', name: 'youtube.show')]
   public function show (Youtube $youtube): Response
   {
      return $this->render('youtube/show.html.twig', [
         'title' => $youtube->getDescription(),
         'h1' => $youtube->getDescription(),
         'video' => $youtube
      ]);
   }
}
