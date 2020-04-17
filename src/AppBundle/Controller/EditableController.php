<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EditableController extends Controller
{
  /**
   * @Route("/editable", name="editable_homepage")
   * @param Request $request
   * @return Response
   */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $users = $manager->getRepository('AppBundle:User')->findAll();
        // dump($users);die();
        return $this->render('editable/index.html.twig', [
            'users' => $users
        ]);
    }

  /**
   * @Route("/editable_process", name="editable_process")
   * @param Request $request
   * @return JsonResponse
   */
    public function processAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $id = $request->request->get('id');
        $first_name = $request->request->get('first_name');
        $last_name = $request->request->get('last_name');
        $action = $request->request->get('action');

        $user = $manager->getRepository('AppBundle:User')->find($id);

        if ($action == 'edit') {
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $manager->persist($user);
        }

        if ($action == 'delete') {
            $manager->remove($user);
        }

        $manager->flush();

        //Symfony 2
        // return new JsonResponse(array('name' => $name));

        // symfony 3
        return $this->json($request->request);
    }
}
