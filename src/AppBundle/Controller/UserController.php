<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 09/05/2020
 * Time: 02:36
 **/

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
  /**
   * @Route("/register", name="user_register")
   */
  public function registerAction(Request $request)
  {
    $form = $this->createForm(UserRegistrationForm::class);

    $form->handleRequest($request);
    if($form->isValid()) {
      /** @var User $user */
      $user = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      $this->addFlash('success', 'Welcome ' . $user->getEmail());

      return $this->redirectToRoute('homepage_genus');
    }

    return $this->render('user/register.html.twig', [
      'form' => $form->createView()
    ]);
  }
}