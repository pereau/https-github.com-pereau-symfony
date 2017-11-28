<?php

namespace AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     *
     * @Route("/users/list",name="user_list")
     */
    public function userAction(Request $request)
    {

        $entityManager=$this->getDoctrine()->getManager();
        $repository=$entityManager->getRepository('AppBundle:User');
        $user1=$repository->find(1);
        $user2=$repository->findOneBy(['id'=>1]);
        $user3=$repository->findAll();
        $usersDesc=$repository->findBy([],['id'=>'desc']);

        return $this->render('default/users.html.twig',['liste_user'=>$usersDesc]);
    }





    /**
     *
     * @Route("/users/add",name="user_add")
     */

    public function addAction(Request $request)
    {
        dump($request);

        $user=new user();
        $form=$this->createForm(UserForm::class,$user);
        $form->handleRequest($request);

        return $this->render('AppBundle::users/add.html.twig',['user'=>$user,'form'=>$form->createView(),]);
    }

    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AcmeMainBundle:USER a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
    }

}

