<?php

namespace App\Controller\AdminAPI;

use App\Repository\InterventionTypeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class InterventionController extends AbstractController
{
    #[Route('/admin/API/interventions', name: "app_admin_api_interventions", methods: ['GET']) ]
    public function index(
        #[MapQueryParameter] int $interventionType,
        InterventionTypeRepository $repo
    )
    {
        $interventionType = $repo->find($interventionType);

        
      
        

        // retourner un tableau serialisé des questions / réponses

        return $interventionType;

        // return $this->json([
        //     [
        //       "text" => "John Doe",
        //       "value" => 1
        //     ],
        //     [
        //       "text" => "John Snow",
        //       "value" => 2
        //     ]
        // ]);
    }
}