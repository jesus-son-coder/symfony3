<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Exp;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @param Request $request
   * @return Response
   */
    public function indexAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // Dummy data :
        $user->setFullname('Jonathan Emmanuel');

        $exp = new Exp();
        $exp->setTitle('Developer');
        $exp->setLocation('Morocco');
        $exp->setDateFrom(new DateTime());
        $exp->setDateTo(new DateTime());

        $user->addExp($exp);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($user);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

  /**
   * @param $geniusName
   * @Route("/genus/{geniusName}")
   * @return Response
   */
    public function showAction($geniusName)
    {
        return $this->render('genus/show.html.twig', array(
          'name' => $geniusName
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
