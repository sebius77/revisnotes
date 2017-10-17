<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Note;
use Symfony\Component\HttpFoundation\JsonResponse;


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


    /**
     * @Route("deleteCat/{id}", name="deleteCat", requirements={"id" = "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {


        if($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            // récupération de la catégorie
            $categorie = $em->getRepository('AppBundle:Categorie')
                ->find($id);

            $em->remove($categorie);

            $em->flush();

            return new JsonResponse(array('message' => true, 200));
        }


        return new JsonResponse(array('message' => false, 400));


    }



    /**
     * @Route("enableCat/{id}", name="enableCat", requirements={"id" = "\d+"})
     */
    public function enableCatAction(Request $request, $id)
    {

        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $categorie = $em->getRepository('AppBundle:Categorie')
                ->find($id);
            $groupement = $categorie->getGroupement();
            $level = $categorie->getNiveau();

            $user = $this->getUser();
            $idUser = $user->getId();

            // récupération de la catégorie
            $categories = $em->getRepository('AppBundle:Categorie')
                ->findGroupementCat($groupement,$level,$idUser);


            foreach($categories as $element)
            {
                $element->setAReviser(1);
                $em->persist($element);
            }

            $em->flush();

            return new JsonResponse(array('message' => true, 200));
        }

        return new JsonResponse(array('message' => false, 200));

    }



    /**
     * @Route("disableCat/{id}", name="disableCat", requirements={"id" = "\d+"})
     */
    public function DisableCatAction(Request $request, $id)
    {


        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $categorie = $em->getRepository('AppBundle:Categorie')
                ->find($id);
            $groupement = $categorie->getGroupement();
            $level = $categorie->getNiveau();

            $user = $this->getUser();
            $idUser = $user->getId();


            // récupération de la catégorie
            $categories = $em->getRepository('AppBundle:Categorie')
                ->findGroupementCat($groupement, $level, $idUser);


            foreach($categories as $element)
            {
                $element->setAReviser(0);
                $em->persist($element);
            }


            $em->flush();

            return new JsonResponse(array('message' => true, 200));
        }

        return new JsonResponse(array('message' => false, 200));


    }





}
