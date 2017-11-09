<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti;
use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommentiClientiController extends Controller
{

    public function indexAction($page)
    {
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('c.id, f.foto, c.nomeCognome, c.commento, c.data, c.approvato')
            ->from('CaffeOlivuzzoAdminBundle:CommentiClienti','c')
            ->innerJoin('CaffeOlivuzzoAdminBundle:FotoClienti', 'f')
            ->where('c.idFoto = f.id')
            ->orderBy('c.data', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        // dql (Doctrine Query Language)
        /*$query = $em->createQuery(
            'SELECT c.id, f.foto, c.nomeCognome, c.commento, c.data, c.approvato
             FROM CaffeOlivuzzoAdminBundle:CommentiClienti c
             INNER JOIN CaffeOlivuzzoAdminBundle:FotoClienti f
             WHERE c.idFoto = f.id
             ORDER BY c.data DESC'
        )
        ->setMaxResults($limit)
        ->setFirstResult($offset);*/

        // memorizzo i risultati nell'array comments
        $comments = $query->getResult();

        // query builder
        $qb = $em->createQueryBuilder()
            ->select('count(c.id)')
            ->from('CaffeOlivuzzoAdminBundle:CommentiClienti','c')
            ->innerJoin('CaffeOlivuzzoAdminBundle:FotoClienti', 'f')
            ->where('c.idFoto = f.id');

        $count = $qb->getQuery()->getSingleScalarResult();

        $totPagine = ceil($count / $limit);

        return $this->render(
            'CaffeOlivuzzoAdminBundle:CommentiClienti:index.html.twig',
            array(
                'comments' => $comments,
                'totPagine' => $totPagine,
                'page' => $page
            )
        );
    }

    public function updateAction($id, Request $request)
    {
        // recupera l’oggetto entity manager di Doctrine
        $em = $this->getDoctrine()->getManager();
        $commento = $em->getRepository('CaffeOlivuzzoAdminBundle:CommentiClienti')->find($id);

        // recupero idFoto del commento dalla tabella commenti_clienti
        $idFoto = $commento->getIdFoto();
        // recupero il nome del file della foto dalla tabella foto_clienti
        $fotoCliente = $em->getRepository('CaffeOlivuzzoAdminBundle:FotoClienti')
                            ->find($idFoto)
                            ->getFoto();

        if (!$commento) {
            throw $this->createNotFoundException(
                'Nessun commento presente nel database con l\'id '.$id
            );
        }
        // passiamo al FormBuilder l'oggetto $commento
        $form = $this->createFormBuilder($commento)
                    ->add('nomeCognome', TextType::class)
                    ->add('commento', TextareaType::class)
                    ->add('approvato', ChoiceType::class, array(
                        'choices'   => array('No' => '0', 'Sì' => '1'),
                        'required'  => false,
                        ))
                    ->add('data', DateTimeType::class, array(
                            'placeholder' => array(
                                'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                                'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                            )
                        ))
                    ->getForm();

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
