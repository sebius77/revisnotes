<?php

namespace AppBundle\Controller;


use AppBundle\Form\NoteType;
use AppBundle\Form\CategorieType;
use AppBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;



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



    /**
     * @Route("read/{id}", name="read", requirements={"id" = "\d+"})
     */
    public function readAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        // récupération de la catégorie
        $note = $em->getRepository('AppBundle:Note')
            ->find($id);

        return $this->render('AppBundle:Default:read.html.twig', array(
            'note' => $note,
        ));
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("edit/{id}", name="edit", requirements={"id" = "\d+"})
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        // récupération de la catégorie
        $note = $em->getRepository('AppBundle:Note')
            ->find($id);



        // On récupèe l'id de la note
        $categorie = $note->getCategorie();

        $catId = $categorie->getId();




        $form = $this->get('form.factory')->create(NoteType::class, $note);

        $formCategorie = $this->get('form.factory')->create(CategorieType::class);




        // Lorsque le formulaire est validé
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {

            $em = $this->getDoctrine()->getManager();

            // $categorie->addNote($note);


            $em->persist($note);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre note a bien été ajoutée.');

            return $this->redirectToRoute('Ajouter');
        }


        return $this->render('AppBundle:Default:ajouter.html.twig', array(
            'catId' => $catId,
            'form' => $form->createView(),
            'formCategorie' => $formCategorie->createView(),
        ));


    }


    /**
     * @Route("deleteNote/{id}", name="deleteNote", requirements={"id" = "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {


        if($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            // récupération de la catégorie
            $note = $em->getRepository('AppBundle:Note')
                ->find($id);

            $em->remove($note);

            $em->flush();

            return new JsonResponse(array('message' => true, 200));
        }


        return new JsonResponse(array('message' => false, 400));


    }


    /**
     * @Route("aReviser", name="AReviser")
     */
    public function reviseAction(Request $request)
    {

        $user = $this->getUser();
        $id = $user->getId();

        $em = $this->getDoctrine()->getManager();

        // récupération de la catégorie
        $note = $em->getRepository('AppBundle:Note')
            ->findLastNote($id);



        return $this->render('AppBundle:Default:aReviser.html.twig', array(
            'note' => $note,
        ));
    }



}