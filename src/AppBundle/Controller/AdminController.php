<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/users",name="adminUsers")
     * Permet l'affichage de tous les comptes
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


    /**
     * @Route("blockUser/{id}", name="blockUser", requirements={"id" = "\d+"})
     */
    public function blockAction(Request $request, $id)
    {
        // On récupère l'entity Manager
        $em = $this->getDoctrine()->getManager();

        // On effectue une requête pour récupérer le User
        $user = $em->getRepository('GebsUserBundle/Repository/User')
            ->find($id);


        if(!null === $user)
        {
            $user->setEnabled(false);
            $em->persist($user);

            $em->flush();

            $this->addFlash(
                'notice',
                'L\'utilisateur ' . $user->getUsername() . ' a été bloqué! '
            );

            return $this->redirectToRoute('adminUsers');

        } else
        {
            $this->addFlash(
                'notice',
                'L\'utilisateur n\'existe pas! '
            );

            return $this->redirectToRoute('adminUsers');
        }




    }

}