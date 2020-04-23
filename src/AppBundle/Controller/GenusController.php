<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
  /**
   * @Route("/genus", name="homepage_genus")
   * @param Request $request
   * @return Response
   */
  public function indexAction(Request $request)
  {
    return $this->render('genus/index.html.twig');
  }


  /**
   * @Route("genus/new")
   */
  public function newAction()
  {
    $genus = new Genus();
    $genus->setName('Octopus'.rand(1, 100));

    $em = $this->getDoctrine()->getManager();
    $em->persist($genus);
    $em->flush();

    return new Response('<html lang="fr"><body>Genus created !</body></html>');
  }

  /**
   * @Route("/genus/list", name="list_genus")
   * @param Request $request
   * @return Response
   */
  public function listAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $genuses = $em->getRepository('AppBundle\Entity\Genus')->findAll();
    // or :
    // $genuses = $em->getRepository('AppBundle:Genus')->findAll();

    return $this->render('genus/list.html.twig', [
      'genuses' => $genuses
    ]);
  }


  /**
   * @param $geniusName
   * @Route("/genus/{geniusName}", name="genus_show")
   * @return Response
   */
  public function showAction($geniusName)
  {
    $em = $this->getDoctrine()->getManager();
    $genus = $em->getRepository('AppBundle:Genus')->findOneBy([
      'name' => $geniusName
    ]);

    if(!$genus) {
      throw $this->createNotFoundException('No genus found !');
    }

    /*
     * Désactiver le Cache :
    $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
    $key = md5($funFact);
    if ($cache->contains($key)) {
      $funFact = $cache->fetch($key);
    } else {
      $funFact = $this->get('markdown.parser')
        ->transform($funFact);
      $cache->save($key, $funFact);
    }
    */

    return $this->render('genus/show.html.twig', array(
      'genus' => $genus,
    ));
  }

  /**
   * @Route("/genus/{genusName}/notes", name="genus_show_notes")
   * @Method("GET")
   */
  public function getNotesAction()
  {
    $notes = [
      ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
      ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
      ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
    ];
    $data = [
      'notes' => $notes
    ];

    return new JsonResponse($data);
  }
}
