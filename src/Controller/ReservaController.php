<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Form\ReservaType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ReservaController extends AbstractController
{
    #[Route('/reservaPista', name:'reservaPista')]
    public function newReserva(Request $request, EntityManagerInterface $em){
        $form = $this->createForm(ReservaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserva = $form->getData();
            $user = $this->getUser();
            $user->addReserva($reserva);
            $em->persist($reserva);
            $em->flush();
            return $this->redirectToRoute('misReservas');
        }
        return $this->renderForm('/reservas/nuevaReserva.html.twig', [
                'reservaForm' => $form
        ]);

    }
    #[Route('/misReservas', name:'misReservas')]
    #[IsGranted('ROLE_USER')]
    public function listReservas(EntityManagerInterface $em)
    {
        $user= $this->getUser();
        $reservas= $user->getReservas();
        return $this->render('/reservas/misReservas.html.twig', [
            'reservas' => $reservas]);
    }
    #[Route('/editarReservas/{id}', name:'editarReservas')]
    public function editarReservas(Request $request, EntityManagerInterface $em,int $id)
    {
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $user=$this->getUser();

        $form = $this->createForm(ReservaType::class,$reserva);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('exito', "Reserva Modificada");
            return $this->redirectToRoute('misReservas');
        }
        return $this->renderForm('/reservas/nuevaReserva.html.twig', [
            'reservaForm' => $form
        ]);


    }
    #[Route('/eliminarReservas/{id}', name:'eliminarReservas')]
    public function eliminarReservas(Request $request, EntityManagerInterface $em,int $id)
    {
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $user = $this->getUser();
        if($reserva == null){
            return new JsonResponse(['error'=> 'La reserva no exite'], 400);
        }
        $em->remove($reserva);
        $em->flush();
        return $this->redirectToRoute('misReservas');


    }





}