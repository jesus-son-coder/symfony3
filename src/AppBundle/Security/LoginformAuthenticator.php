<?php

namespace AppBundle\Security;

use AppBundle\Form\LoginForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 18/04/2020
 * Time: 22:48
 **/

use Symfony\Component\Form\FormFactoryInterface;

class LoginformAuthenticator extends AbstractFormLoginAuthenticator
{
  /**
   * @var FormFactoryInterface
   */
  private $formFactory;


  public function __construct(FormFactoryInterface $formFactory)
  {
    $this->formFactory = $formFactory;
  }

  public function getCredentials(Request $request)
  {
    // $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
    // ou, au lieu de coder en dur l'url '/login', on peut utiliser le nom de la route ('security_login') comme ci-dessous :
    // Si les deux conditions ci-dessous sont réunies, alors le User vient de soumettre le Formulaire de Login :
    $isLoginSubmit = $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');

    if(!$isLoginSubmit) {
      /* If you return null from getCredentials(),
        Symfony skips trying to authenticate the user
        and the request continues on like normal. */
      return null;
    }

    /* A partir d'ici, on est bien dans la situation où
     * 1) L'url est "/login"
     * 2) La méthode de la requête est bien 'POST'
     *
     * ...Ainsi :
     * If the user is trying to login, our new task is to fetch the username & password and return them.
     */
    // 1) Création d'un formulaire de Login, et récupération des élément
    $form = $this->formFactory->create(LoginForm::class);
    $form->handleRequest($request);

    // 2) Ici, on récupère effectivement, depuis le formulaire LoginForm créé ci-dessus, le "username" et le "password" sous forme d'un tableau associatif => ['_username' => 'xxx', '_password' => 'xxx'] :
    $data = $form->getData();

    return $data;
  }

  public function getUser($credentials, UserProviderInterface $userProvider)
  {
    // TODO: Implement getUser() method.
  }

  public function checkCredentials($credentials, UserInterface $user)
  {
    // TODO: Implement checkCredentials() method.
  }

  protected function getLoginUrl()
  {
    // TODO: Implement getLoginUrl() method.
  }


  protected function getDefaultSuccessRedirectUrl()
  {
  }
}