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
     * Page mes notes, Affiche toutes le catégories avec la pagination
     */
    public function indexAction($page)
    {

        $user = $this->getUser();
        $id = $user->getId();

        $em = $this->getDoctrine()->getManager();

        // Récupération des catégories en fonction de la page et l'id utilisateur
        $listCategories = $em->getRepository('AppBundle:Categorie')
            ->findAllUserCatTrie($page, 9, $id);

        // 4) La vue s'occupe de parser les catégories et afficher les catégories Mères
        return $this->render('AppBundle:Default:mesNotes.html.twig', array(
            'listCategories' => $listCategories,
            'page'  => $page,
            'nombrePage' => ceil(count($listCategories)/9)
        ));
    }

    /**
     * @Route("read/{id}", name="read", requirements={"id" = "\d+"})
     * Méthode permettant l'affichage d'une note
     */
    public function readAction($id)
    {

        // Prévoir la vérification de la note en fonction de l'utilisateur

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
    public function editAction(Request $request, $id)
    {

        // Vérification de l'appartenance de la note

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
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

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

        // Vérification de l'apartencance de la note

        if ($request->isXmlHttpRequest()) {
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
     * Méthode permettant l'affichage de la note à réviser en fonction de la date la plus lointaine
     */
    public function reviseAction()
    {

        $user = $this->getUser();
        $id = $user->getId();

        $em = $this->getDoctrine()->getManager();

        // récupération de la note
        $note = $em->getRepository('AppBundle:Note')
            ->findLastNote($id);

        return $this->render('AppBundle:Default:aReviser.html.twig', array(
            'note' => $note,
        ));
    }

    /**
     * @param $id
     * @param $bouton
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Cette méthode permet au clic de modifier la date de révision de la note
     * @Route("autoEval/{id}/{bouton}", name="autoEval")
     */
    public function autoEvalAction($id, $bouton)
    {
        $user = $this->getUser();

        // Prévoir un contrôle sur l'idUser

        $em = $this->getDoctrine()->getManager();

        $note = $em->getRepository('AppBundle:Note')
            ->find($id);

        $today = new \DateTime();

        $parametres = $user->getParametres();

        $revoir = $parametres->getRevoir();
        $difficile = $parametres->getDifficile();
        $bien = $parametres->getBien();
        $parfait = $parametres->getParfait();

        switch ($bouton) {
            case 'revoir':
                $newDate = $today->add(new \DateInterval('P' . $revoir . 'D'));
                break;
            case 'difficile':
                $newDate = $today->add(new \DateInterval('P' . $difficile . 'D'));
                break;
            case 'bien':
                $newDate = $today->add(new \DateInterval('P' . $bien . 'D'));
                break;
            case 'parfait':
                $newDate = $today->add(new \DateInterval('P' . $parfait . 'D'));
                break;
            default:
                $newDate = false;
        }

        $note->setDateRevision($newDate);

        $em->persist($note);

        $em->flush();

        return $this->redirectToRoute('AReviser');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("search", name="search")
     */
    public function searchAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $term = $request->get('motcle');

            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            $idUser = $user->getId();

            $notesUser = $em->getRepository('AppBundle:Note')
                ->findAllByUser($idUser, $term);

            return new JsonResponse(array('data' => $notesUser, 200));
        }

        return new JsonResponse(array('data' => false, 400));
    }

    /**
     * @Route("resultSearch", name="resultSearch")
     */
    public function resultAction(Request $request)
    {

        // Lorsque le formulaire est validé
        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('objetId');

            // Traitement pour voir si la note appartient bien à l'utilisateur et qu'elle existe

            $em = $this->getDoctrine()->getManager();

            // Vérification si la recherche existe
            $note = $em->getRepository('AppBundle:Note')
                ->find($id);

            if ($note) {
                return new JsonResponse(array('message' => true, 200));
            }
        }
        return new JsonResponse(array('message' => false, 400));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("countNote", name="countNote")
     * Méthode permettant de récupérer le nombre de note à réviser
     */
    public function nbNoteAreviserAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $user = $this->getUser();
            $idUser = $user->getId();

            // Récupérer le repository des notes
            $em = $this->getDoctrine()->getManager();

            $nbNote = $em->getRepository('AppBundle:Note')
                ->findAllNoteAreviser($idUser);

            $count = count($nbNote);

            if ($nbNote) {
                return new JsonResponse(array('message' => $count, 200));
            }
        }

        return new JsonResponse(array('message' => false, 400));
    }
}
