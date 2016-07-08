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

    public function changeLocaleAction(Request $request)
    {
        $lg = $request->get('langue');

        $request = $this->getRequest();
        $request->setLocale($lg);

        return $this->redirect($this->generateUrl('tobook_homepage', array('_locale' => $lg)));
    }  


    public function searchAction(Request $request)
    {   
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');
        $prix = $request->query->get('prix');
        $etoiles = $request->query->get('etoiles');
        $note = $request->query->get('note');
        $order = array();
        switch ($prix) {
            case "asc":
                $order = array("profPrixMini" => "asc");
                break;
            case "desc":
                $order = array("profPrixMini" => "desc");
                break;
        } 
        switch ($etoiles) {
            case "asc":
                $order = array("profEtoiles" => "asc");
                break;
            case "desc":
                $order = array("profEtoiles" => "desc");
                break;
        } 
        switch ($note) {
            case "asc":
                $order = array("profId" => "asc");
                break;
            case "desc":
                $order = array("profId" => "desc");
                break;
        }
        // var_dump($order);
        
        $criteria = array();
        $repository = $this->getDoctrine()
            ->getRepository('WCSPropertyBundle:Professionnel');
        $listeresultats =  $repository->findBy($criteria, $order, null);
        // $resultats =  $repository->findOneByProfId('1');
        // replace this example code with whatever you need

        //Systeme de pagination ci dessous

        $resultats = $this->get('knp_paginator')->paginate($listeresultats, /* Ici on appelle la liste d'entité qu'on veut voir apparaitre en tant qu'éléments de notre pagination */
            $this->get('request')->query->get('page', 1)/*Ici la page à laquelle la pagination commence*/,
            14/*Et ici la limite d'éléments par page*/
        );

        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'resultats' => $resultats,
        ));
    } 
}
