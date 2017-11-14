<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\HttpFoundation\Request;
use CaffeOlivuzzo\AdminBundle\Form\FotoClientiType;

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

    public function updateAction($id, Request $request)
    {
        // recupera l’oggetto entity manager di Doctrine
        $em = $this->getDoctrine()->getManager();
        $foto = $em->getRepository('CaffeOlivuzzoAdminBundle:FotoClienti')->find($id);
        // memorizzo percorso cartella foto che prendo da parameters in config.yml
        $fotosPath = $this->getParameter('fotos_directory');
        // memorizzo nome vecchia foto
        $vecchia_foto = $foto->getFoto();

        if (!$foto) {
            throw $this->createNotFoundException(
                'Nessuna foto presente nel database con l\'id '.$id
            );
        }

        $form = $this->createForm(FotoClientiType::class, $foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            // dopo che il form è stato inviato controllo se l'array $_FILES contiene una foto
            if ( $foto->getFoto() )
            {
                $file = $foto->getFoto();

                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                // Move the file to the directory where fotos are stored
                $file->move(
                    $this->getParameter('fotos_directory'),
                    $fileName
                );

                // Update the 'foto' property to store the file name instead of its contents
                $foto->setFoto($fileName);
                // cancella vecchia foto
                unlink($fotosPath.$vecchia_foto);

            } else {
                $foto->setFoto($vecchia_foto);
            }
            // ... persist the $foto variable or any other work
            $em->persist($foto);
            // Quando il metodo flush() è richiamato, il gestore di entità esegue una query
            $em->flush();

            return $this->redirect($this->generateUrl('_fotos'));
        }

        return $this->render(
            'CaffeOlivuzzoAdminBundle:FotoClienti:update.html.twig',
            array(
                'form' => $form->createView(),
                'foto' => $foto
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
