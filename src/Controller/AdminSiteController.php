<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSiteController extends AbstractController
{
    #[Route('/admin/site', name: 'app_adminSite')]
    public function index(): Response
    {
        return $this->render('admin_site/index.html.twig', [
            'controller_name' => 'AdminSiteController',
        ]);
    }
}
