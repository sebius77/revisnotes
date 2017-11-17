<?php

// src/AppBundle/Service/tabCategories.php

namespace AppBundle\Service;

class TabCategories
{

    private $tabCategries = [];

    public function __construct()
    {
    }

    /**
     * @param $listCategories
     * @return mixed
     */
    public function getCategorieWithChildren($listCategories)
    {

        // On créé un tableau de catégories avec pour index leur id
        $categories_id = [];

        foreach ($listCategories as $cat) {
            $categories_id[$cat->getId()] = $cat;
        }

        // Ensuite on parse le tableau d'origine
        foreach ($listCategories as $index => $cat) {
            // Si la catégorie à un id parent, cela signifie qu'elle
            // est enfant d'une catégorie
            if ($cat->getIdParent() != null) {
                $categories_id[$cat->getIdParent()]->setChildren($cat);
                unset($listCategories[$index]);
            }
        }
        return $listCategories;
    }

    /**
     * @return array
     */
    public function getTabCategries()
    {
        return $this->tabCategries;
    }

    /**
     * @param $data
     */
    public function setTabCategories($data)
    {
        $this->tabCategries[]= $data;
    }
}
