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
            'title' => 'Toutes les vidéos',
            'h1' => 'Toutes les vidéos',
            'videos' => $videos,
            'previous' => $offset - YoutubeRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($videos), $offset + YoutubeRepository::PAGINATOR_PER_PAGE)
        ]);
    }

   #[Route('/video/{id}', name: 'youtube.show')]
   public function show (Youtube $youtube): Response
   {
      $this->addFlash('category', 'yes');
      return $this->render('youtube/show.html.twig', [
         'title' => $youtube->getDescription(),
         'h1' => $youtube->getDescription(),
         'video' => $youtube
      ]);
   }

   #[Route('/videos/{category}', name: 'youtube.category')]
   public function category (string $category, YoutubeRepository $repository, Request $request): Response
   {
      $offset = max(0, $request->query->getInt('offset', 0));
      $youtubes = $repository->findByCategory($category, $offset);

      $this->addFlash('category', 'yes');
      return $this->render('youtube/index.html.twig', [
         'title' => 'Catégorie ' . $category,
         'h1' => 'Catégorie ' . $category,
         'videos' => $youtubes,
         'previous' => $offset - YoutubeRepository::PAGINATOR_PER_PAGE,
         'next' => min(count($youtubes), $offset + YoutubeRepository::PAGINATOR_PER_PAGE)
      ]);
   }
}
