<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index(UsersRepository  $repo): Response
    {
        //$users=$repo->finAll();
        return $this->render('users/listUsers.html.twig', [
            'controller_name' => 'UsersController',
            /* 'users'=>$users*/
        ]);
    }
}
