<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCartController extends AbstractController
{
    #[Route('/user/cart', name: 'app_user_cart')]
    public function index(CartRepository $cartRepository): Response
    {
         // Récupérez uniquement le panier de l'utilisateur actuellement connecté
         $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);

        return $this->render('user_cart/index.html.twig', [
            // 'controller_name' => 'UserCartController',
            'cart' => $cart
        ]);
    }
    // Ajoutez d'autres méthodes pour gérer les actions spécifiques au panier de l'utilisateur
}
