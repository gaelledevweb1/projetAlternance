<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPaiementController extends AbstractController
{
    #[Route('/user/paiement', name: 'app_user_paiement')]
    public function index(): Response
    {
        return $this->render('user_paiement/index.html.twig', [
            'controller_name' => 'UserPaiementController',
        ]);
    }
}
