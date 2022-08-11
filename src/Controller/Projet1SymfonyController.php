<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Projet1SymfonyController extends AbstractController
{
    #[Route('/projet1/symfony', name: 'app_projet1_symfony')]
    public function index(): Response
    {
        return $this->render('projet1_symfony/index.html.twig', [
            'controller_name' => 'Projet1SymfonyController',
        ]);
    }
}
