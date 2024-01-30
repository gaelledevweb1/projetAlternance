<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartRepository $cartRepository,
    PaginatorInterface $paginator,
    Request $request): Response
    {
//  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $carts = $paginator->paginate(
            // $query, /* query NOT result */
                $carts=$cartRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );

        //        $carts=$cartRepository->findAll();
        //  dd($carts);
        return $this->render('cart/index.html.twig', [
            // 'controller_name' => 'CartController',
            'carts' => $carts
        ]);
       
    }

    

    #[Route("/cart/nouveau",name:"app_cart.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class,$cart);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $cart = $form->getdata();
            // dd($cart);
            $manager->persist($cart);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouveau panier a été creer avec succes !'
            );

           return $this->redirectToRoute('app_cart');

        }

        return $this->render('cart/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }
    
    #[Route('/cart/{id}', name: 'app_cart.show')]
    public function show(CartRepository $cartRepository,
    int $id): Response
    {
        $cart = $cartRepository->findOneBy(["id" => $id]);
        //  dd($cart);
        return $this->render('cart/show.html.twig', [
            // 'controller_name' => 'CartController',
            'cart' => $cart
        ]);
    }

    #[Route("/cart/edition/{id}",name:"app_cart.edit",methods:["GET","POST"])]
    // public function edit(cartRepository $cartRepository,int $id): Response
    public function edit(Cart $cart,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity cart)

        // $cart = $cartRepository->findOneBy(["id" => $id]);
        //  dd($cart);
        $form = $this->createForm(CartType::class,$cart);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $cart = $form->getdata();
            // dd($cart);
            $manager->persist($cart);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouveau panier a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_cart');

        }

        return $this->render('cart/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/cart/suppression/{id}",name:"app_cart.delete",methods:["GET"])]
    public function delete(Cart $cart,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$cart)
        { $this->addFlash(
            'success',
            'votre  panier en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($cart);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  cart a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_cart');
    }
}
