<?php

// src/AppBundle/Service/tabCategories.php


namespace AppBundle\Service;


class TabCategories
{

    private $tabCategries = [];



    public function getCategorieWithChildren($listCategories)
    {

        // On créé un tableau de résultat
        $tabResult = [];

        // On créé un tableau de catégories avec pour index leur id
        $categories_id = [];

        foreach($listCategories as $cat)
        {
            $categories_id[$cat->getId()] = $cat;
        }

        // Ensuite on parse le tableau d'origine
        foreach($listCategories as $cat) {

            // Si la catégorie à un id parent, cela signifie qu'elle
            // est enfant d'une catégorie
            if($cat->getIdCategoriePArent() != null) {
                $categories_id[$cat->getId()][] = $cat;
            }

            $tabResult[] = $categories_id[$cat->getId()];
        }



        foreach($tabResult as $id => $cat)
        {
            $this->setTabCategories([
                'id' => $id,
                'nom' => $cat->getNom(),
                'idCategorieParent' => $cat->getIdCategorieParent(),
            ]);
        }


        return $this->getTabCategries();

    }



    public function getTabCategries()
    {
        return $this->tabCategries;
    }


    public function setTabCategories($data)
    {
        $this->tabCategries[]= $data;
    }







}