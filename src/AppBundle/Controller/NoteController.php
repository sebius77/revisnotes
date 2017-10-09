<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class NoteController extends Controller
{

    /**
     * @Route("mesNotes", name="mesNotes")
     */
    public function indexAction(Request $request)
    {


        // 1) On récupère toutes les catégories

        // récupération de toutes les catégories via un repository
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Categorie');

        // On récupère toutes les catégories
        $listCategories = $repository->findAll();


        // 2) On envoit le tableau des catégories à la vue




        // 3) Il faut calculer le nombre de catégories et permettre un affichage de 12 catégories Max
        // Dans le cas ou il y a plus de catégories, on le gère avec une pagination




        // 4) La vue s'occupe de parser les catégories et afficher les catégories Mères
        return $this->render('AppBundle:Default:mesNotes.html.twig', array(
            'listCategories' => $listCategories,
        ));
    }

}