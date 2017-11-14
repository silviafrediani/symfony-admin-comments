<?php

namespace CaffeOlivuzzo\AdminBundle\Controller;

use CaffeOlivuzzo\AdminBundle\Form\UserType;
use CaffeOlivuzzo\AdminBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
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

            // $message = (new \Swift_Message('Hello Email'))
            //     ->setFrom('florencesettantotto@gmail.com')
            //     ->setTo('silvia.frediani@tiscali.it')
            //     ->setBody(
            //         $this->renderView(
            //             'CaffeOlivuzzoAdminBundle:Registration:email.html.twig'
            //             //array('name' => $name)
            //         ),
            //         'text/html'
            //     );
            //
            // $this->get('mailer')->send($message);

            return $this->redirectToRoute('_utenti');
        }

        return $this->render(
            'CaffeOlivuzzoAdminBundle:Registration:register.html.twig',
            array('form' => $form->createView())
        );
    }
}
