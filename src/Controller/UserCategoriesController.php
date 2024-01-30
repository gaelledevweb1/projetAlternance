<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCategoriesController extends AbstractController
{
    #[Route('/user/categories', name: 'app_user_categories')]
    public function index(): Response
    {
        return $this->render('user_categories/index.html.twig', [
            'controller_name' => 'UserCategoriesController',
        ]);
    }
}
