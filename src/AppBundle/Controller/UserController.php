<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Parametres;
use AppBundle\Form\ParametresType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



class UserController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("settings", name="settings")
     */
    public function settingsAction(Request $request)
    {

        // Il faut récupérer les paramètres de l'utilisateur et les transmettre à la vue

        $user = $this->getUser();

        // récupération des paramètres de l'utilisateur courant
        $settings = $user->getParametres();

        $form = $this->get('form.factory')->create(ParametresType::class, $settings);



        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {

            $em = $this->getDoctrine()->getManager();

            $em->persist($settings);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice','Mise à jour des paramètres');

            return $this->redirectToRoute('settings');



        }




        return $this->render('AppBundle:User:settings.html.twig', array(
            'settings' => $form->createView(),
        ));


    }


}