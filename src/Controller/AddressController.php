<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AddressController extends AbstractController
{
    #[Route('/address', name: 'app_address')]
    public function index(AddressRepository $addressRepository,
    PaginatorInterface $paginator,Request $request): Response
    {
//  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $addresses = $paginator->paginate(
            // $query, /* query NOT result */
                $addresses=$addressRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );

        //        $addresses=$addressRepository->findAll();
        //  dd($addresses);
   
        return $this->render('address/index.html.twig', [
            //  'controller_name' => 'AddressController',
             'addresses' => $addresses
            
        ]);
    }

    

    #[Route("/address/nouveau",name:"app_address.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class,$address);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $address = $form->getdata();
            // dd($address);
            $manager->persist($address);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'vôtre nouvelle addresse a été creer avec succes !'
            );

           return $this->redirectToRoute('app_address');

        }

        return $this->render('address/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }

    #[Route('/address/{id}', name: 'app_address.show')]
    // public function show(AddressRepository $addressRepository,Address $address): Response
    public function show(Address $address): Response
    {
        
        // $address = $addressRepository->findOneBy(["id" => $id]);
        //  dd($address);
   
        return $this->render('address/show.html.twig', [
            //  'controller_name' => 'AddressController',
             'address' => $address
            
        ]);
    }
    
    

    #[Route("/address/edition/{id}",name:"app_address.edit",methods:["GET","POST"])]
    // public function edit(addressRepository $addressRepository,int $id): Response
    public function edit(Address $address,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity address)

        // $address = $addressRepository->findOneBy(["id" => $id]);
        //  dd($address);
        $form = $this->createForm(AddressType::class,$address);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $address = $form->getdata();
            // dd($address);
            $manager->persist($address);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre  addresse été modifié avec succes !'
            );

           return $this->redirectToRoute('app_address');

        }

        return $this->render('address/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/address/suppression/{id}",name:"app_address.delete",methods:["GET"])]
    public function delete(Address $address,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$address)
        { $this->addFlash(
            'success',
            'votre  addresse en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($address);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  utilisateur a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_address');
    }
}


