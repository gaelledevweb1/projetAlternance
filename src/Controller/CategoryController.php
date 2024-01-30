<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository,
    PaginatorInterface $paginator,
    Request $request): Response
    {
        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $categories = $paginator->paginate(
            // $query, /* query NOT result */
                $categories=$categoryRepository->findAll(),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
             );

        //        $categories=$categoryRepository->findAll();
        //  dd($categories);
        return $this->render('category/index.html.twig', [
            // 'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    
    #[Route("/category/nouveau",name:"app_category.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $category = new category();
        $form = $this->createForm(categoryType::class,$category);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $category = $form->getdata();
            // dd($category);
            $manager->persist($category);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouvelle categorie a été creer avec succes !'
            );

           return $this->redirectToRoute('app_category');

        }

        return $this->render('category/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }

    #[Route('/category/{id}', name: 'app_category.show')]
    public function show(CategoryRepository $categoryRepository,
    int $id): Response
    {
        $category = $categoryRepository->findOneBy(["id" => $id]);
        //  dd($category);

        return $this->render('category/show.html.twig', [
            // 'controller_name' => 'CategoryController',
            'category' => $category
        ]);
    }

    

    #[Route("/category/edition/{id}",name:"app_category.edit",methods:["GET","POST"])]
    // public function edit(categoryRepository $categoryRepository,int $id): Response
    public function edit(Category $category,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity category)

        // $category = $categoryRepository->findOneBy(["id" => $id]);
        //  dd($category);
        $form = $this->createForm(CategoryType::class,$category);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $category = $form->getdata();
            // dd($category);
            $manager->persist($category);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre categorie a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_category');

        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/category/suppression/{id}",name:"app_category.delete",methods:["GET"])]
    public function delete(Category $category,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$category)
        { $this->addFlash(
            'success',
            'votre  categorie en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($category);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  category a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_category');
    }
}
