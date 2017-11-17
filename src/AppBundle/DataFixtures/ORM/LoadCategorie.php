<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategorie.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Categorie;

class LoadCategorie implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Informatique',
            'Anglais',
            'Graphisme',
            'Réseau'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $categorie = new Categorie();
            $categorie->setNom($name);

            // On la persiste
            $manager->persist($categorie);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
