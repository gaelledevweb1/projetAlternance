<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserArticleController extends AbstractController
{
    #[Route('/user/article', name: 'app_user_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
    

        return $this->render('user_article/index.html.twig', [
             'controller_name' => 'UserArticleController',
            
        ]);
    }
}
