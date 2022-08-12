<?php

namespace App\DataFixtures;

use App\Entity\Employes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 10; $i++) { 
            $employes = new Employes();
            $employes->setPrenom("Prénom de l'employé : $i")->setNom("Nom de l'employé : $i")->setTelephone("Téléphone : $i")->setEmail("Email : $i")->setAdresse("Adresse : $i")->setPoste("Poste : $i")->setSalaire(300.35 + $i)->setDatedenaissance("Date de naissance : $i");
            $manager->persist($employes);
        }
        

        $manager->flush();
    }
}
