<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class NoteController extends Controller
{

    /**
     * @Route("mesNotes/{page}", name="mesNotes", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function indexAction($page)
    {


        $user = $this->getUser();
        $id = $user->getId();


        $em = $this->getDoctrine()->getManager();

        $listCategories = $em->getRepository('AppBundle:Categorie')
            ->findAllUserCatTrie($page, 9,$id);





        // 4) La vue s'occupe de parser les catégories et afficher les catégories Mères
        return $this->render('AppBundle:Default:mesNotes.html.twig', array(
            'listCategories' => $listCategories,
            'page'  => $page,
            'nombrePage' => ceil(count($listCategories)/9)
        ));
    }

}