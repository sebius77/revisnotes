<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdminController extends Controller
{
    /**
     * @Route("/admin/users",name="adminUsers")
     */
    public function adminAction()
    {

        $em = $this->getDoctrine()->getManager();

        // récupération de l'entité User
        $users = $em->getRepository('GebsUserBundle:User')
            ->findAll();

        return $this->render('AppBundle:Admin:admin.html.twig', array(
            'users' => $users,
        ));

    }

}