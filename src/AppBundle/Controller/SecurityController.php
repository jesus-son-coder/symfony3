<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
  /**
   * @param Request $request
   * @Route("/login", name="security_login")
   * @return Response
   */
  public function loginAction(Request $request)
  {
      /*
      // Création d'un User avec un Password crypté :
      $user = new User();
      $user->setEmail('michael_student@gmail.com');
      $user->setPlainPassword('mike');
      $user->setRoles(['ROLE_ADMIN']);
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      */

    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    $form = $this->createForm(LoginForm::class,[
      '_username' => $lastUsername
    ]);

    return $this->render(
      'security/login.html.twig',
      array(
        // last username entered by the user
        'form' => $form->createView(),
        'error' => $error,
      )
    );
  }

  /**
   * @Route("/logout", name="security_logout")
   */
  public function logoutAction()
  {

  }
}
