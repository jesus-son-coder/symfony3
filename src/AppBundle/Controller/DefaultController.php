<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 *
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @param Request $request
   * @return Response
   */
    public function indexAction(Request $request)
    {
      return $this->render('genus/index.html.twig');
    }


  /**
   * @Route("/admin", name="admin_homepage")
   * @param Request $request
   *
   * @Security("is_granted('ROLE_ADMIN')")
   *
   * @return Response
   */
  public function adminIndexAction(Request $request)
  { /*
    if(!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
      throw $this->createAccessDeniedException('GET OUT !');
    } */
    return $this->render('genus/admin-index.html.twig');
  }
}
