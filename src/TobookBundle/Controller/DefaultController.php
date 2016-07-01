<?php

namespace TobookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TobookBundle:Default:index.html.twig');
    }

    public function searchAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('WCSPropertyBundle:Professionnel');
        $resultats =  $repository->findBy(array(), null, 5, null);
        // $resultats =  $repository->findOneByProfId('1');
        // replace this example code with whatever you need
        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'resultats'    => $resultats,
        ));
    }  

}
