<?php
namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $repo): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $repo->findAll(),
        ]);
    }

    #[Route('/event/{id}', name: 'app_event_show')]
    public function show(int $id, EventRepository $repo, Request $request, EntityManagerInterface $em): Response
    {
        $event = $repo->find($id);
        if (!$event) {
            throw $this->createNotFoundException('Événement introuvable.');
        }

        $reservation = new Reservation();
        $reservation->setEvent($event);

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', '✅ Réservation confirmée ! Merci.');
            return $this->redirectToRoute('app_event_show', ['id' => $id]);
        }

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'form'  => $form,
        ]);
    }
}
