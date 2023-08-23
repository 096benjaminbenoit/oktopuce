<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route(
        '/{reactRouting}',
        name: 'app_index',
        requirements: ["reactRouting" => "^(?!api|_profiler|build|admin).+"],
        defaults: ["reactRouting" => null]
    )]
    public function index(): Response
    {
        return $this->render('react_app/index.html.twig', []);
    }
}
