<?php
// src/AppBundle/Service/LevelCategorie.php


namespace AppBundle\Service;


use AppBundle\Entity\Categorie;



class LevelCategorie
{

    private $em;


    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }


    public function findLevel($idParent)
    {
        $level = 1;
        $levelCatParent = null;

        // On vérifie si la catégorie en question est fille d'une autre catégorie
        if($idParent !== null)
        {
            // On récupère le repository de l'entité catégorie
            $repository = $this->getEm()->getRepository('AppBundle:Categorie');

            // On récupère la catégorie mère
            $catParent = $repository->find($idParent);

            // On récupère le niveau de la catégorie mère et on incrémente de 1
            $levelCatParent = $catParent->getNiveau();
        }

        $levelCat = $level + $levelCatParent;

        return($levelCat);

    }


    public function getEm()
    {
        return $this->em;
    }





}
