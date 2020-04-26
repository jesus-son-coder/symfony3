<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 26/04/2020
 * Time: 21:49
 **/

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GenusAdminController
 * @package AppBundle\Controller\Admin
 * @Route("/admin", name="admin_genus_list")
 */
class GenusAdminController extends Controller
{
  /**
   * @Route("/genus", name="admin_genus_list")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function indexAction()
  {
    $genuses = $this->getDoctrine()
        ->getRepository('AppBundle:Genus')
        ->findAll();

    return $this->render('admin/genus/list.html.twig', array(
      'genuses' => $genuses
    ));
  }

  /**
   * @Route("/genus/new", name="admin_genus_new")
   */
  public function newAction()
  {

  }
}