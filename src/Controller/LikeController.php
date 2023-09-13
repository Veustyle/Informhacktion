<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Youtube;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/{id}', name: 'like')]
    public function index(Youtube $youtube, LikeRepository $likeRepository, EntityManagerInterface $manager): Response
    {
       if (!$this->getUser()) {
          $this->addFlash('error', 'Veuillez vous connecter pour liker une vidéo');
          return $this->redirectToRoute('home');
       }
       $user = $this->getUser();
       $like = $likeRepository->findOneBy(['fromUser' => $user, 'ToYoutube' => $youtube]);

       if (!$like) {
          $like = new Like();
          $user->addLike($like);
          $youtube->addLike($like);
          $manager->persist($like);
          $manager->flush();
          return $this->json(['message' => 'La vidéo a été likée !', 'nbLikes' => count($youtube->getLikes())]);
       }

       $youtube->removeLike($like);
       $user->removeLike($like);
       $manager->remove($like);
       $manager->flush();
       return $this->json(['message' => 'Le like a été supprimé', 'nbLikes' => count($youtube->getLikes())]);
    }
}
