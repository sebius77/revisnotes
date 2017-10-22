<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;





class FooterController extends Controller
{


    /**
     * @Route("contact", name="contact")
     * Méthode permettant l'accès au formulaire de contact
     * et l'envoi d'un message
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {

        $contact = new Contact();
        $form = $this->get('form.factory')->create(ContactType::class, $contact);


        // Lorsque le formulaire est validé
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {


            $message = (new \Swift_Message($form['subject']->getData()))
                ->setFrom($form['email']->getData())
                ->setTo('sebgaudin@yahoo.fr')
                ->setBody(
                    $form['body']->getData()
                    );


            $mailer->send($message);

           // return $this->redirectToRoute('AppBundle:Footer:contact.html.twig');

            // prévoir un message FlashBag pour l'envoi du message
        }


        return $this->render('AppBundle:Footer:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("why", name="why")
     */
    public function whyAction()
    {
        return $this->render('AppBundle:Footer:why.html.twig');
    }




}