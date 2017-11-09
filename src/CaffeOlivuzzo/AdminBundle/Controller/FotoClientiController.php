<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FotoClientiController extends Controller
{

    public function indexAction()
    {
        $fotos = $this->getDoctrine()
                     ->getRepository('CaffeOlivuzzoAdminBundle:FotoClienti')
                     ->findAll();

        return $this->render(
            'CaffeOlivuzzoAdminBundle:FotoClienti:index.html.twig',
            array(
                'fotos' => $fotos
            )
        );
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $foto = $em->getRepository('CaffeOlivuzzoAdminBundle:FotoClienti')->find($id);
     
        if (!$foto) {
            throw $this->createNotFoundException(
                'Nessuna foto presente nel database con l\'id '.$id
            );
        }
     
        $em->remove($foto);
        $em->flush();
     
        return $this->redirect($this->generateUrl('_fotos'));
    }    



}
