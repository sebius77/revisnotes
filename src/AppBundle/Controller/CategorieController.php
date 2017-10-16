<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Note;


class CategorieController extends Controller
{

    /**
     * @Route("categorie/{id}", name="categorie", requirements={"id" = "\d+"})
     */
    public function CategorieAction($id)
    {

        // Vérification à prévoir sur l'id de la catégorie
        // pour protéger les catégories des utilisateurs


        $em = $this->getDoctrine()->getManager();


        // récupération de la catégorie
        $categorie = $em->getRepository('AppBundle:Categorie')
            ->find($id);


       // $notes = $categorie->getNotes();


        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:categorie.html.twig', array(
            'categorie' => $categorie,
        ));
    }

}
