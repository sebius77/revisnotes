<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @Route("admin/blockUser/{id}", name="blockUser", requirements={"id" = "\d+"})
     */
    public function blockAction(Request $request, $id)
    {
        // On récupère l'entity Manager
        $em = $this->getDoctrine()->getManager();

        // On effectue une requête pour récupérer le User
        $user = $em->getRepository('GebsUserBundle:User')
            ->find($id);

            $user->setEnabled(false);
            $em->persist($user);

            $em->flush();

            $this->addFlash(
                'notice',
                'L\'utilisateur ' . $user->getUsername() . ' a été bloqué! '
            );

            return $this->redirectToRoute('adminUsers');
    }

    /**
     * @Route("admin/enableUser/{id}", name="enableUser", requirements={"id" = "\d+"})
     */
    public function enableAction(Request $request, $id)
    {
        // On récupère l'entity Manager
        $em = $this->getDoctrine()->getManager();

        // On effectue une requête pour récupérer le User
        $user = $em->getRepository('GebsUserBundle:User')
            ->find($id);

        $user->setEnabled(true);
        $em->persist($user);

        $em->flush();

        $this->addFlash(
            'notice',
            'Le compte de l\'utilisateur ' . $user->getUsername() . ' a été activé! '
        );

        return $this->redirectToRoute('adminUsers');
    }

    /**
     * @Route("admin/deleteUser/{id}", name="deleteUser", requirements={"id" = "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {

        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            // récupération de la catégorie
            $user = $em->getRepository('GebsUserBundle:User')
                ->find($id);

            $em->remove($user);

            $em->flush();

            return new JsonResponse(array('message' => true, 200));
        }

        return new JsonResponse(array('message' => false, 400));
    }
}
