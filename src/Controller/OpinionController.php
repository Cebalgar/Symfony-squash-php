<?php

namespace App\Controller;

use App\Entity\Opiniones;
use App\Form\OpinionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OpinionController extends AbstractController
{

    #[Route('/opinion', name:'opinion')]
    public function newOpinion(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(OpinionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserva = $form->getData();
            $user = $this->getUser();
            $user->addOpinione($reserva);
            $em->persist($reserva);
            $em->flush();
            return $this->redirectToRoute('allOpinions');
        }
        return $this->renderForm('/opiniones/nuevaOpinion.html.twig', [
            'opinionForm' => $form
        ]);
    }
    #[Route('/allOpinions', name:'allOpinions')]
    public function listOpinions(EntityManagerInterface $em)
    {
       $opiniones =$em->getRepository(Opiniones::class)->findAll();
        return $this->render('opiniones/opiniones.html.twig', [
            'opiniones' => $opiniones]);
    }

}