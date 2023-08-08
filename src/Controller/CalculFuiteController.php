<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalculFuiteController extends AbstractController
{
    #[Route('/calcul/fuite', name: 'app_calcul_fuite')]
    public function calculFuite(EquipementRepository $equipementRepository): Response
    {   
        //achaque fois que je change la datte du controlle fuite je doit changer la datte du prochain controlle
        //je veut récupérer les équipement pour vérifier si il y a une fuite 
        // si il y a une fuite je veut pourvoir effectuer un calcul pour vérifier les fuites 
        // et retouner la datte de la prochaine vérification
        //sinon je ne fait rien 
        $equipements = $equipementRepository->findAll();

        foreach ($equipements as $isLeakDetection ){
           if ($isLeakDetection.isLeakDetection == true ){


           } 

        }
     
     
        return
       
    }

    
}