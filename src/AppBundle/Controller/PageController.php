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

            // En modifiant la base de données l'utilisateur n'est plus directement relié aux note
            // mais aux catégories. Les lignes qui suivent devront s'appliquer à l'ajout des catégories
            //$user = $this->getUser();
            //$note->setUser($user);
            $em = $this->getDoctrine()->getManager();

            $em->persist($note);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre note a bien été ajoutée.');

            return $this->redirectToRoute('Ajouter');
        }


        // Traitement pour l'ajout des catégories en Ajax
        if($request->isXmlHttpRequest()) {

            $formCategorie->handleRequest($request);

            // Pour récupérer la valeur du champ nom des catégories - OK
            $nom = $formCategorie->get('nom')->getData();

            // Pour récupérer la valeur du champ idParent
            $idParent = $formCategorie->get('idParent')->getData();

            // Concernant l'image, tout d'abord on récupère le nom de l'image - OK
            $file = $_FILES['appbundle_categorie'];

            // On récupère le service pour l'upload de fichier - ok
            $fileUploader = $this->container->get('file_uploader');

            // On upload le fichier image
            $upload = $fileUploader->upload($file);

            // Dans le cas ou l'upload à fonctionner
            // On enregistre la catégorie en base de données
            if($upload)
            {
                $categorie->setNom($nom);
                $categorie->setIdParent($idParent);
                $categorie->setImage($fileUploader->getFileName());

                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();


            } else {
                // Prévoir un message au cas ou l'upload n'aurait pas fonctionné
                return new JsonResponse(array('message' => 'false', 400));
            }

            return new JsonResponse(array('message' => $upload, 200));
        }


        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:ajouter.html.twig', array(
            'form' => $form->createView(),
            'formCategorie' => $formCategorie->createView(),
        ));
    }







    /**
     * @Route("refreshList", name="refreshList")
     * Méthode permettant de rafraîchir la liste des catégories
     */
    public function refreshListAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {


            // récupération de toutes les catégories via un repository
            $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Categorie');

            // On récupère toutes les catégories
            $listCategories = $repository->findAll();

            // Ensuite nous allons parser les catégories via un service
            // Ceci pour transmettre un tableau des catégories mères et de leurs enfants
            // Il faudra également prévoir lors de leur suppression, la supression des enfants
            // et de leurs notes avec une demande de confirmation.

            // On récupère le service pour parser les catégories
            $tabCategories = $this->container->get('tab_categories');

            // On traite les catégories avec le service
            $tabTest = $tabCategories->getCategorieWithChildren($listCategories);

            $result = [];
            foreach($tabTest as $item )
            {
                $result[]= $item->to_json_encode();
            }


           // return new JsonResponse(array('listCategories' => $result, 200));
            return new JsonResponse($result);

        }

        return new JsonResponse(array('listCategories' => 'erreur', 400));

    }



}
