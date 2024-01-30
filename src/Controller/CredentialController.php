<?php

namespace App\Controller;

use App\Entity\Credentials;
use App\Entity\User;
use App\Repository\CredentialsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CredentialController extends AbstractController
{




    #[Route('/credential', name: 'app_credential')]
    public function index(
        CredentialsRepository $credentialsRepository,
        PaginatorInterface $paginator,
        Request $request,
        

        ): Response {
        //  creation d'un index de page  : 
        //  $pagination remplacer par $users
        $credentiales = $paginator->paginate(
            // $query, /* query NOT result */
            $credentiales = $credentialsRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        

        //        $credentiales=$credentialRepository->findAll();
        //  dd($credentiales);
        return $this->render('credential/index.html.twig', [
            // 'controller_name' => 'CredentialController',
            'credentiales' => $credentiales
        ]);
    }

    #[Route('/credential/{id}/promote', name: 'credential_promote')]
public function promote($id, credentialsRepository $credentialsRepository, EntityManagerInterface $entityManager): Response
{
    $credentiales = $credentialsRepository->find($id);

    if (!$credentiales) {
        throw $this->createNotFoundException('No user found for id '.$id);
    }

    $credentiales->setRoles(['ROLE_ADMIN']);

    $entityManager->persist($credentiales);
    $entityManager->flush();

    $this->addFlash(
        'success',
        'The user has been promoted to admin successfully!'
    );

    return $this->redirectToRoute('app_credential');
}
}
