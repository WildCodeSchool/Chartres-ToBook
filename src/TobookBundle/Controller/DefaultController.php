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

        $latitude = $request->request->get('latitude');
        $longitude = $request->request->get('longitude');

        $prix = $request->request->get('prix');
        $etoiles = $request->request->get('etoiles');
        $notes = $request->request->get('note');

        $order = "";

        switch ($prix) {
            case "asc":
                $order = array("prof_prix_mini" )=> "asc");
                break;
            case "desc":
                $order = array("prof_prix_mini" )=> "desc");
                break;
        } 

        switch ($etoiles) {
            case "asc":
                $order = array("prof_etoiles" )=> "asc");
                break;
            case "desc":
                $order = array("prof_etoiles" )=> "desc");
                break;
        } 

        switch ($notes) {
            case "asc":
                $order = array("prof_etoiles" )=> "asc");
                break;
            case "desc":
                $order = array("prof_etoiles" )=> "desc");
                break;
        } 
        $criteria = array();
        $repository = $this->getDoctrine()
            ->getRepository('WCSPropertyBundle:Professionnel');
        $resultats =  $repository->findBy($criteria, $order, 15, null);
        // $resultats =  $repository->findOneByProfId('1');
        // replace this example code with whatever you need
        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'resultats'    => $resultats,
        ));
    }  

}
