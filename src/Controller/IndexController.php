<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'video_path' => '././files/video/WIN_20220419_12_59_46_Pro.mp4',
        ]);
    }
}
