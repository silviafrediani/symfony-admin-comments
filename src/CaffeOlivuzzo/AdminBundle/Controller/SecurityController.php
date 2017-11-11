<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
         $authenticationUtils = $this->get('security.authentication_utils');

         // recupera l'errore, se ce n'è uno
         $error = $authenticationUtils->getLastAuthenticationError();

         // ultimo nome utente inserito
         $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render(
             'CaffeOlivuzzoAdminBundle:Security:login.html.twig',
             array(
                 // last username entered by the user
                 'last_username' => $lastUsername,
                 'error'         => $error,
             )
         );
    }
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }
}
