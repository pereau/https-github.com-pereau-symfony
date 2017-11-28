<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller {



    /**
     *
     * @Route("/articlesadd",name="homepage4")
     */

    public function articleAction(Request $request)
    {

        $entityManager=$this->getDoctrine()->getManager();
        $repository=$entityManager->getRepository('AppBundle:User');
        $article1=$repository->find(1);
        $article2=$repository->findOneBy(['id'=>1]);
        $article3=$repository->findAll();
        $articlesDesc=$repository->findBy([],['id'=>'desc']);

        return $this->render('default/articles.html.twig',['liste_article'=>$articlesDesc]);
    }





    public function addAction(Request $request)
    {
        dump($request);

        $article=new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        return $this->render('AppBundle::articles/add.html.twig',['user'=>$article,'form'=>$form->createView(),]);
    }

    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AcmeMainBundle:Article a";
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

