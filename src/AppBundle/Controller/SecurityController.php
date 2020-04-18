<?php

namespace AppBundle\Controller;

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
}
