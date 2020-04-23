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
   * @param $geniusName
   * @Route("/genus/{geniusName}")
   * @return Response
   */
  public function showAction($geniusName)
  {
    $funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second!';

    $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
    $key = md5($funFact);
    if ($cache->contains($key)) {
      $funFact = $cache->fetch($key);
    } else {
      $funFact = $this->get('markdown.parser')
        ->transform($funFact);
      $cache->save($key, $funFact);
    }

    return $this->render('genus/show.html.twig', array(
      'name' => $geniusName,
      'funFact' => $funFact
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