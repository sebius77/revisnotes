<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class UserController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("settings", name="settings")
     */
    public function settingsAction()
    {

        // Il faut récupérer les paramètres de l'utilisateur et les transmettre à la vue





        return $this->render('AppBundle:User:settings.html.twig');


    }


}