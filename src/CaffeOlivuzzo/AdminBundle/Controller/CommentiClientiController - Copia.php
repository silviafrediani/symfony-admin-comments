<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti;
use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
        $qb = $em->createQueryBuilder();
        $qb->select('count(c.id)');
        $qb->from('CaffeOlivuzzoAdminBundle:CommentiClienti','c');
        $qb->innerJoin('CaffeOlivuzzoAdminBundle:FotoClienti', 'f');
        $qb->where('c.idFoto = f.id');

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
