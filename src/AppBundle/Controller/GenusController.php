<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use AppBundle\Service\MarkdownTransformer;
use Faker\Factory;
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
    $em = $this->getDoctrine()->getManager();
    $faker = Factory::create();

    $genus = new Genus();
    $genus->setName('Octopus'.rand(1, 100));
    $genus->setSubFamily('Octopodinae');;
    $genus->setFunFact($faker->sentence(10, true));
    $genus->setSpeciesCount(rand(100,5000));
    $genus->setIsPublished(true);
    $em->persist($genus);

    $genusNote = new GenusNote();
    $genusNote->setUsername($faker->userName);
    $genusNote->setUserAvatarFileNname('50%? leanna.jpeg : ryan.jpeg');
    $genusNote->setNote($faker->paragraph);
    $genusNote->setCreatedAt($faker->dateTimeBetween('-6 months', 'now'));
    $genusNote->setGenus($genus);
    $em->persist($genusNote);

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
    $genuses = $em->getRepository('AppBundle\Entity\Genus')
              ->findAllPublishedOrderedByRecentActive();
    // or :
    // $genuses = $em->getRepository('AppBundle:Genus')->findAll();

    return $this->render('genus/list.html.twig', [
      'genuses' => $genuses
    ]);
  }


  /**
   * @param $name
   * @Route("/genus/{name}", name="genus_show")
   * @return Response
   */
  public function showAction($name)
  {
    $em = $this->getDoctrine()->getManager();
    $genus = $em->getRepository('AppBundle:Genus')->findOneBy([
      'name' => $name
    ]);

    if(!$genus) {
      throw $this->createNotFoundException('No genus found !');
    }

    $transformer = new MarkdownTransformer($this->get('markdown.parser'));
    $funFact = $transformer->parse($genus->getFunFact());

    $recentNotes = $em->getRepository('AppBundle:GenusNote')->findAllRecentNotesForGenus($genus);

    return $this->render('genus/show.html.twig', array(
      'genus' => $genus,
      'funFact' => $funFact,
      'recentNotesCount' => count($recentNotes)
    ));
  }

  /**
   * @Route("/genus/{name}/notes", name="genus_show_notes")
   * @Method("GET")
   * @param Genus $genus
   * @return JsonResponse
   */
  public function getNotesAction(Genus $genus)
  {
    $notes = [];
    foreach ($genus->getNotes() as $note) {
      $notes[] = [
        'id' => $note->getId(),
        'username' => $note->getUsername(),
        'avatarUri' => '/images/' . $note->getUserAvatarFileNname(),
        'note' => $note->getNote(),
        'date' => $note->getCreatedAt()->format('M d, Y')
      ];
    }

    $data = [
      'notes' => $notes
    ];

    return new JsonResponse($data);
  }
}
