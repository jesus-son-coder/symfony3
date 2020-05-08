<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 26/04/2020
 * Time: 21:49
 **/

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Genus;
use AppBundle\Form\GenusFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GenusAdminController
 * @package AppBundle\Controller\Admin
 * @Route("/admin", name="admin_genus_list")
 */
class GenusAdminController extends Controller
{
  /**
   * @Route("/genus", name="admin_genus_list")
   * @return Response
   */
  public function indexAction()
  {
    /**
     * Refuser l'accès à la page Index via le Contrôleur (ci-dessous) :
     * ----------------------------------------------------------------
     */
    /* Méthode 1 :
     * -----------
     if(!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException('GET OUT !');
    }*/
    /* Méthode 2 (plus simple et courte) :
     * -----------------------------------
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
    */

    $genuses = $this->getDoctrine()
        ->getRepository('AppBundle:Genus')
        ->findAll();

    return $this->render('admin/genus/list.html.twig', array(
      'genuses' => $genuses
    ));
  }

  /**
   * @Route("/genus/new", name="admin_genus_new")
   * @param Request $request
   * @return Response
   */
  public function newAction(Request $request)
  {
    $form = $this->createForm(GenusFormType::class);

    // Handles data on POST
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      $genus = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($genus);
      $em->flush();

      $this->addFlash('success','Genus created - you are amazing!');

      return $this->redirectToRoute('admin_genus_list');
    }

    return $this->render('admin/genus/new.html.twig', [
      'genusForm' => $form->createView()
    ]);
  }


  /**
   * @Route("/genus/{id}/edit", name="admin_genus_edit")
   * @param Request $request
   * @param Genus $genus
   * @return Response
   */
  public function editAction(Request $request, Genus $genus)
  {
    $form = $this->createForm(GenusFormType::class, $genus);

    // Handles data on POST
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      $genus = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($genus);
      $em->flush();

      $this->addFlash('success','Genus updated - you are amazing!');

      return $this->redirectToRoute('admin_genus_list');
    }

    return $this->render('admin/genus/edit.html.twig', [
      'genusForm' => $form->createView()
    ]);
  }

}