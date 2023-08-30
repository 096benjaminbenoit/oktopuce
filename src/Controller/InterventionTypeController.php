<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Entity\InterventionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InterventionRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\InterventionTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/interventionType')]
class InterventionTypeController extends AbstractController
{
    #[Route('/', name: 'app_intervation_index', methods: ['GET'])]
    public function index(InterventionTypeRepository $interventionTypeRepository): Response
    {
        return $this->render('intervention/index.html.twig', [
            'interventionType' => $interventionTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_interventionType_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $interventionType = new InterventionType();
        $form = $this->createForm(InterventionType::class, $interventionType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($interventionType);
            $entityManager->flush();

            return $this->redirectToRoute('app_interventionType_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('intervention/new.html.twig', [
            'interventionType' => $interventionType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_interventionType_show', methods: ['GET'])]
    public function show(InterventionType $interventionType): Response
    {
        return $this->render('intervention/show.html.twig', [
            'interventionType' => $interventionType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_interventionType_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InterventionType $interventionType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InterventionType::class, $interventionType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_interventionType_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('intervention/edit.html.twig', [
            'interventionType' => $interventionType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_interventionType_delete', methods: ['POST'])]
    public function delete(Request $request, InterventionType $interventionType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$interventionType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($interventionType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_interventionType_index', [], Response::HTTP_SEE_OTHER);
    }
}
