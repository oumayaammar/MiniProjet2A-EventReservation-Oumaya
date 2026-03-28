<?php
namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function dashboard(EventRepository $repo): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'events' => $repo->findAll(),
        ]);
    }

    #[Route('/event/new', name: 'admin_event_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();
            $this->addFlash('success', 'Événement créé !');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/event_form.html.twig', [
            'form'  => $form,
            'title' => 'Nouvel événement',
        ]);
    }

    #[Route('/event/{id}/edit', name: 'admin_event_edit', methods: ['GET','POST'])]
    public function edit(int $id, EventRepository $repo, Request $request, EntityManagerInterface $em): Response
    {
        $event = $repo->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Événement modifié !');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/event_form.html.twig', [
            'form'  => $form,
            'title' => 'Modifier l\'événement',
        ]);
    }

    #[Route('/event/{id}/delete', name: 'admin_event_delete', methods: ['POST'])]
    public function delete(int $id, EventRepository $repo, EntityManagerInterface $em, Request $request): Response
    {
        $event = $repo->find($id);
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $em->remove($event);
            $em->flush();
            $this->addFlash('success', 'Événement supprimé !');
        }
        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/event/{id}/reservations', name: 'admin_event_reservations')]
    public function reservations(int $id, EventRepository $repo, ReservationRepository $resRepo): Response
    {
        $event = $repo->find($id);
        return $this->render('admin/reservations.html.twig', [
            'event'        => $event,
            'reservations' => $resRepo->findBy(['event' => $event]),
        ]);
    }
}