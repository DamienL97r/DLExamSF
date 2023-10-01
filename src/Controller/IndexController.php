<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/index')]
class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(UserRepository $userRepository): Response
    {


        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            "users" => $userRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_index_item')]
    public function item(User $user): Response
    {


        return $this->render('index/item.html.twig', [
            'controller_name' => 'IndexController',
            "user" => $user,
        ]);
    }
}
