<?php

namespace App\Controller;

use App\Entity\Credentials;
use App\Repository\CredentialsRepository;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository,PaginatorInterface $paginator,Request $request): Response
    {

        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
           $users = $paginator->paginate(
            // $query, /* query NOT result */
                $users=$userRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );
    


        // $users=$userRepository->findAll();
        //  dd($users);
        
            
            return $this->render('user/index.html.twig', [
            // 'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

    #[Route("/user/nouveau",name:"app_user.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $user = $form->getdata();
            // dd($user);
            $manager->persist($user);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'vôtre nouvel utilisateur à été creer avec succes !'
            );

           return $this->redirectToRoute('app_user');

        }

        return $this->render('user/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }
    
    #[Route("/user/{id}", name:"app_user.show", methods:["GET"])]
    public function show(User $user,CredentialsRepository $credentialsRepository): Response
    {
        // $credential = $credentialsRepository->findOneBy(['user' => $user]);

        $credential = $user->getCredentials();

        // Si $credential est null, vous pouvez le définir à une valeur par défaut
        if ($credential === null) {
            $credential = new Credentials(); 
        }

         // Utilisation de la méthode findUserByUsername
    $userFromUsername = $credentialsRepository->findUserByUsername($credential->getUserName());
    if ($userFromUsername) {
        // L'utilisateur existe
        dump($userFromUsername);
    } else {
        // L'utilisateur n'existe pas
        dump('L\'utilisateur n\'a pas été trouvé');
    }
    
    
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'credential' => $credential,
        ]);
    }

    #[Route("/user/edition/{id}",name:"app_user.edit",methods:["GET","POST"])]
    // public function edit(UserRepository $userRepository,int $id): Response
    public function edit(User $user,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity User)

        // $user = $userRepository->findOneBy(["id" => $id]);
        //  dd($user);
        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $user = $form->getdata();
            // dd($user);
            $manager->persist($user);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouvel utilisateur a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_user');

        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/user/suppression/{id}",name:"app_user.delete",methods:["GET"])]
    public function delete(User $user,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$user)
        { $this->addFlash(
            'success',
            'votre  utilisateur en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($user);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  utilisateur a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_user');
    }
}
