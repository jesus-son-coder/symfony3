<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Langage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Language;

class MultiselectorController extends Controller
{
    /**
     * @Route("/multiseletor", name="multiselector_home")
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $langages = $manager->getRepository('AppBundle:Langage')->findAll(['name' => 'ASC']);

        return $this->render('multiselector/index.html.twig', [
            'langages' => $langages
        ]);
    }
}
