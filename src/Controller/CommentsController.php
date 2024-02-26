<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsCrudType;
use App\Repository\CommentsRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/*use Symfony\Component\DependencyInjection\Loader\Configurator\request;*/

class CommentsController extends AbstractController
{
    /**
     * @Route("/moderationComments", name="app_moderationComments")
     */
    public function index(CommentsRepository  $repo): Response
    {
        $comments = $repo->findAll();
        return $this->render('comments/moderationComments.html.twig', [
            //'controller_name' => 'CommentsController',
            "comments" =>$comments,
        ]);
    }
        /**
     * @Route("/comments/create", name="app_createComments")
     */
    public function create(Request $request): Response
    {
        $crud = new Comments();#entity
        $form = $this->createForm(CommentsCrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table articles
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();
        }
        return $this->render('events/event.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }
            /**
     * @Route("/comments/delete/{id}", name="app_deleteComments")
     */
    public function delete($id, Request $request): Response
    {
        $crud = $this->getDoctrine()->getRepository(Comments::class)->find($id);
        $form = $this->createForm(CommentsCrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table articles
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->remove($crud);
            $sendDatabase->flush();
        }
        return $this->render('events/event.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }
}