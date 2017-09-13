<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Note;
use AppBundle\Form\NoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        $note = new Note();
        $form = $this->get('form.factory')->create(NoteType::class, $note);


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


        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}


