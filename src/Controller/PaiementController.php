<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PaiementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(PaiementRepository $paiementRepository,
    PaginatorInterface $paginator,
    Request $request): Response
    {
        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $paiements = $paginator->paginate(
            // $query, /* query NOT result */
                $paiements=$paiementRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );

        //        $paiements=$paiementRepository->findAll();
        //  dd($paiements);
        return $this->render('paiement/index.html.twig', [
            // 'controller_name' => 'PaiementController',
            'paiements' => $paiements
        ]);
    }

    

    #[Route("/paiement/nouveau",name:"app_paiement.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $paiement = new Paiement();
        $form = $this->createForm(PaiementType::class,$paiement);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $paiement = $form->getdata();
            // dd($paiement);
            $manager->persist($paiement);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouveau paiement a été creer avec succes !'
            );

           return $this->redirectToRoute('app_paiement');

        }

        return $this->render('paiement/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }

    #[Route('/paiement/{id}', name: 'app_paiement.show')]
    public function show(PaiementRepository $paiementRepository,
    int $id): Response
    {
        $paiement = $paiementRepository->findOneBy(["id" => $id]);
        //  dd($paiement);

        return $this->render('paiement/show.html.twig', [
            // 'controller_name' => 'PaiementController',
            'paiement' => $paiement
        ]);
    }
    

    #[Route("/paiement/edition/{id}",name:"app_paiement.edit",methods:["GET","POST"])]
    // public function edit(paiementRepository $paiementRepository,int $id): Response
    public function edit(Paiement $paiement,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity paiement)

        // $paiement = $paiementRepository->findOneBy(["id" => $id]);
        //  dd($paiement);
        $form = $this->createForm(PaiementType::class,$paiement);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $paiement = $form->getdata();
            // dd($paiement);
            $manager->persist($paiement);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre paiement a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_paiement');

        }

        return $this->render('paiement/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/paiement/suppression/{id}",name:"app_paiement.delete",methods:["GET"])]
    public function delete(Paiement $paiement,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$paiement)
        { $this->addFlash(
            'success',
            'votre  commande en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($paiement);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  commande a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_paiement');
    }
}
