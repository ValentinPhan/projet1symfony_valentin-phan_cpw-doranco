<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Projet1SymfonyController extends AbstractController
{
    #[Route('/projet1_symfony', name: 'app_projet1_symfony')]
    public function index(EmployesRepository $repo): Response
    {
        $employes = $repo->findAll();
        return $this->render('projet1_symfony/index.html.twig', [
            'controller_name' => 'Projet1SymfonyController',
            'tabEmployes' => $employes
        ]);
    }
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('projet1_symfony/home.html.twig', [
            'title' => 'Accueil'
        ]);
    }
    #[Route('/projet1_symfony/show/{id}', name: 'projet1_symfony_show')]
    public function show($id, EmployesRepository $repo)
    {
        $employes = $repo->find($id);
        return $this->render('projet1_symfony/show.html.twig', ['employes' => $employes]);
    }
    #[Route('/projet1_symfony/new', name: 'projet1_symfony_create')]
    #[Route('/projet1_symfony/edit/{id}', name: 'projet1_symfony_edit')]
    public function form(Request $superglobals, EntityManagerInterface $manager, Employes $employes = null)
    {
        if (!$employes) { 
            $employes = new Employes; 
        }       
        $form = $this->createForm(EmployesType::class, $employes);
        $form->handleRequest($superglobals);
        if ($form->isSubmitted() && $form->isValid()) {         
            $manager->persist($employes); 
            $manager->flush(); 
            return $this->redirectToRoute('projet1_symfony_show', ['id' => $employes->getId()]);
        }
        return $this->renderForm("projet1_symfony/form.html.twig", ['formEmployes' => $form, 'editMode' => $employes->getId() !== NULL]);
    }
    #[Route('/projet1_symfony/delete/{id}', name: 'projet1_symfony_delete')]
    public function delete(EntityManagerInterface $manager, $id, EmployesRepository $repo)
    {
        $employes = $repo->find($id);
        $manager->remove($employes);
        $manager->flush();
        $this->addFlash('success', "L'article a bien été retiré !");
        return $this->redirectToRoute("app_projet1_symfony");
    }
}
