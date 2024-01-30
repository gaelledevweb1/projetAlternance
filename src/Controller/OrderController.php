<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrderRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(OrderRepository $orderRepository,
    PaginatorInterface $paginator,
    Request $request): Response
    {
        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $orders = $paginator->paginate(
            // $query, /* query NOT result */
                $orders=$orderRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );

        //        $orders=$orderRepository->findAll();
        //  dd($orders);
        return $this->render('order/index.html.twig', [
            // 'controller_name' => 'OrderController',
            'orders' => $orders
        ]);
    }

    

    #[Route("/order/nouveau",name:"app_order.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class,$order);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $order = $form->getdata();
            // dd($order);
            $manager->persist($order);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouvelle commande a été creer avec succes !'
            );

           return $this->redirectToRoute('app_order');

        }

        return $this->render('order/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }
    
    #[Route('/order/{id}', name: 'app_order.show')]
    public function show(OrderRepository $orderRepository,
    int $id): Response
    {
        $order = $orderRepository->findOneBy(["id" => $id]);
        //  dd($order);

        return $this->render('order/show.html.twig', [
            // 'controller_name' => 'OrderController',
            'order' => $order
        ]);
    }

    #[Route("/order/edition/{id}",name:"app_order.edit",methods:["GET","POST"])]
    // public function edit(orderRepository $orderRepository,int $id): Response
    public function edit(Order $order,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity order)

        // $order = $orderRepository->findOneBy(["id" => $id]);
        //  dd($order);
        $form = $this->createForm(OrderType::class,$order);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $order = $form->getdata();
            // dd($order);
            $manager->persist($order);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre commande a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_order');

        }

        return $this->render('order/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/order/suppression/{id}",name:"app_order.delete",methods:["GET"])]
    public function delete(Order $order,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$order)
        { $this->addFlash(
            'success',
            'votre  commande en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($order);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  commande a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_order');
    }
}
