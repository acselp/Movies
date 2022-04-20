<?php

namespace App\Controller;
use App\Entity\Movies;
use App\Repository\MoviesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\MakerBundle\Doctrine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'app_movie')]
    public function index(MoviesRepository $moviesRepo, int $id, EntityManagerInterface $em): Response
    {

        $repo = $em->getRepository(Movies::class);
        $movie = $repo->find($id);

        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
            'video_path' => $movie->getPath(),
            //'root' => $root
        ]);
    }
}
