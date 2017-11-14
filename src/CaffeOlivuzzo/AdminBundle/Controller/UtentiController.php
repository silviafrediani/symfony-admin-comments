<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\User;
use CaffeOlivuzzo\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UtentiController extends Controller
{

    public function indexAction()
    {
        $utenti = $this->getDoctrine()
                     ->getRepository('CaffeOlivuzzoAdminBundle:User')
                     ->findAll();

        return $this->render(
            'CaffeOlivuzzoAdminBundle:Utenti:index.html.twig',
            array(
                'utenti' => $utenti
            )
        );
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utente = $em->getRepository('CaffeOlivuzzoAdminBundle:User')->find($id);

        if (!$utente) {
            throw $this->createNotFoundException(
                'Nessun utente presente nel database con l\'id '.$id
            );
        }

        $em->remove($utente);
        $em->flush();

        return $this->redirect($this->generateUrl('_utenti'));
    }


    public function updateAction(Request $request, UserInterface $user)
    {

        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('_utenti');

        }
        return $this->render(
            'CaffeOlivuzzoAdminBundle:Utenti:update.html.twig',
            array(
                'form' => $form->createView()
            )
        );


    }

}
