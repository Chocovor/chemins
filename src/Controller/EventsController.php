<?php

namespace App\Controller;

use App\Form\EventsCrudType;
use Doctrine\Migrations\Events;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="app_events")
     */
    public function index(EventsRepository  $repo): Response
    {
        $events = $repo->findAll();
        return $this->render('events/events.html.twig', [
            //'controller_name' => 'EventsController',
            "events" => $events,
        ]);
    }

        /**
     * @Route("/event/{id}", name="app_event")
     */
    public function ficheEvent($id, EventsRepository  $repo): Response
    {
        $event = $repo->find($id);
        return $this->render('events/event.html.twig', [
            //'controller_name' => 'EventsController',
            "event" => $event,
        ]);
    }

           /**
     * @Route("/event/create", name="app_createEvent", methods= {"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $crud = new Events();#entity
        $form = $this->createForm(EventsCrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table Events
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();

            $this->addFlash('notice', 'Soumission réussi !!');

            return $this->redirectToRoute("app_Events"); #redirection vers la page des évènements

        }

        return $this->render('Events/createEvent.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }

           /**
     * @Route("/event/delete/{id}", name="app_deleteEvent", methods= {"GET", "POST"})
     */
    public function delete($id, Request $request): Response
    {
        $crud = $this->getDoctrine()->getRepository(Events::class)->find($id);
        $form = $this->createForm(EventsCrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table Events
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->remove($crud);
            $sendDatabase->flush();

            $this->addFlash('notice', 'Suppression réussi !!');

            return $this->redirectToRoute("app_Events"); #redirection vers la page des évènements

        }

        return $this->render('Events/deleteEvent.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }

           /**
     * @Route("/event/update/{id}", name="app_updateEvent", methods= {"GET", "POST"})
     */
    public function update($id, Request $request): Response
    {
        $crud = $this->getDoctrine()->getRepository(Events::class)->find($id);
        $form = $this->createForm(EventsCrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table Events
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();

            $this->addFlash('notice', 'Modification réussi !!');

            return $this->redirectToRoute("app_Events"); #redirection vers la page des évènements
        }

        return $this->render('Events/updateEvent.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }
}
