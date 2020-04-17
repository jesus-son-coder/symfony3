<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Exp;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
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
        $templating = $this->container->get('templating');
        $html = $templating->render('genus/show.html.twig', array(
          'name' => $geniusName
        ));

        return new Response($html);
    }
}
