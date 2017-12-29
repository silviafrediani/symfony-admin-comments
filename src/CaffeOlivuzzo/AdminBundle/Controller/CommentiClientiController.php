<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti;
use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\HttpFoundation\Request;
use CaffeOlivuzzo\AdminBundle\Form\CommentiClientiType;


class CommentiClientiController extends Controller
{

    public function indexAction()
    {
        $fotos = $this->getDoctrine()
                     ->getRepository('CaffeOlivuzzoAdminBundle:FotoClienti')
                     ->findAll();

        return $this->render(
            'CaffeOlivuzzoAdminBundle:CommentiClienti:index.html.twig',
            array(
                'fotos' => $fotos
            )
        );
    }

    public function updateAction($id, Request $request)
    {
        // recupera l’oggetto entity manager di Doctrine
        $em = $this->getDoctrine()->getManager();
        $commento = $em->getRepository('CaffeOlivuzzoAdminBundle:CommentiClienti')->find($id);

        // recupero il nome del file della foto dalla tabella correlata foto_clienti
        $fotoCliente = $commento->getIdFoto()->getFoto();

        if (!$commento) {
            throw $this->createNotFoundException(
                'Nessun commento presente nel database con l\'id '.$id
            );
        }

        $form = $this->createForm(CommentiClientiType::class, $commento);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            // Il metodo persist() dice a Doctrine di “gestire” l’oggetto $commento. Questo non fa (ancora) eseguire una query sula base dati.
            $em->persist($commento);
            // Quando il metodo flush() è richiamato, il gestore di entità esegue una query
            $em->flush();

            return $this->redirect($this->generateUrl('_comments'));
        }

        return $this->render(
            'CaffeOlivuzzoAdminBundle:CommentiClienti:update.html.twig',
            array(
                'form' => $form->createView(),
                'id' => $id,
                'fotoCliente' => $fotoCliente
            )
        );

    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commento = $em->getRepository('CaffeOlivuzzoAdminBundle:CommentiClienti')->find($id);

        if (!$commento) {
            throw $this->createNotFoundException(
                'Nessun commento presente nel database con l\'id '.$id
            );
        }

        $em->remove($commento);
        $em->flush();

        return $this->redirect($this->generateUrl('_comments'));
    }

}
