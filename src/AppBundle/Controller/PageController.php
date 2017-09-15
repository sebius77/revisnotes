<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Note;
use AppBundle\Form\CategorieType;
use AppBundle\Form\NoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    /**
     * @Route("accueil", name="Accueil")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:accueil.html.twig');
    }


    /**
     * @Route("aReviser", name="AReviser")
     */
    public function reviseAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:aReviser.html.twig');
    }

    /**
     * @Route("ajouter", name="Ajouter")
     */
    public function ajouteAction(Request $request)
    {
        // instanciation de l'objet Note
        $note = new Note();
        $form = $this->get('form.factory')->create(NoteType::class, $note);


        // instanciation de l'objet Categorie
        $categorie = new Categorie();
        $formCategorie = $this->get('form.factory')->create(CategorieType::class);


        // Lorsque le formulaire est validé
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $user = $this->getUser();
            $note->setUser($user);
            $em = $this->getDoctrine()->getManager();

            $em->persist($note);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre note a bien été ajoutée.');

            return $this->redirectToRoute('Ajouter');
        }


        // Traitement pour l'ajout des groupes en Ajax
        if($request->isXmlHttpRequest()) {

            $categorie = $request->getContent();

            //$em = $this->getDoctrine()->getManager();
            //$em->persist($categorie);
            //$em->flush();


                return new JsonResponse(array('message' => $categorie), 200);
        }


        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:ajouter.html.twig', array(
            'form' => $form->createView(),
            'formCategorie' => $formCategorie->createView(),
        ));
    }

}
