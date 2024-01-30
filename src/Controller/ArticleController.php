<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $articles = $paginator->paginate(
            // $query, /* query NOT result */
            $articles = $articleRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //        $articles=$addressRepository->findAll();
        //  dd($articles);

        return $this->render('article/index.html.twig', [
            // 'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }

    

    #[Route("/article/nouveau",name:"app_article.new",methods:["GET","POST"])]
    public function new(Request $REQUEST,
    EntityManagerInterface $manager
    ): Response
    {
        $article = new article();
        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $article = $form->getdata();
            // dd($article);
            $manager->persist($article);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre nouvel article a été creer avec succes !'
            );

           return $this->redirectToRoute('app_article');

        }

        return $this->render('article/new.html.twig',[
             'form' => $form->createView(),
       
        ]);
    }
    
    #[Route('/article/{id}', name: 'app_article.show')]
    public function show(ArticleRepository $articleRepository, int $id): Response
    {
        $article = $articleRepository->findOneBy(["id" => $id]);
        //  dd($article);

        return $this->render('article/show.html.twig', [
            // 'controller_name' => 'ArticleController',
            'article' => $article
        ]);
    }

    #[Route("/article/edition/{id}",name:"app_article.edit",methods:["GET","POST"])]
    // public function edit(articleRepository $articleRepository,int $id): Response
    public function edit(Article $article,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        // source : https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
        // rearder Usage ( objectif ne pas reprendre l'id car il existe deja ds l'entity article)

        // $article = $articleRepository->findOneBy(["id" => $id]);
        //  dd($article);
        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($REQUEST);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $article = $form->getdata();
            // dd($article);
            $manager->persist($article);
            $manager->flush();

            
            //  source: https://symfony.com/doc/current/controller.html#flash-messages
            //  aller dans : Managing the Session
            //  $this->addFlash(
                // 'notice',
                // 'Your changes were saved!'
            // );

            $this->addFlash(
                'success',
                'votre article a été modifié avec succes !'
            );

           return $this->redirectToRoute('app_article');

        }

        return $this->render('article/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/article/suppression/{id}",name:"app_article.delete",methods:["GET"])]
    public function delete(Article $article,Request $REQUEST,
    EntityManagerInterface $manager): Response
    {
        if(!$article)
        { $this->addFlash(
            'success',
            'votre  article en question n\' a pas été trouvé !'
        );}


        // source : https://symfony.com/doc/current/doctrine.html#deleting-an-object
        // regarder Deleting an Object

        $manager->remove($article);
        $manager->flush();

        
        
        $this->addFlash(
            'success',
            'votre  article a été supprimé avec succes !'
        );

        return $this->redirectToRoute('app_article');
    }
}
