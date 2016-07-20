<?php

namespace WCS\RatingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WCS\RatingBundle\Entity\RatingProperty;


class DefaultController extends Controller
{
    public function ratingPropertyAction(Request $request, $profCode)
    {

    	$em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $userid = $user->getId();
        $note = $request->query->get('note');
        // permet de récupérer l'id de l'établissement écrit dans l'url après son nom (via une regex qui supprime les caractères non numériques)
        // $profId = preg_replace("/\D/",'', $profCode);
        
        $etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneByprofCode($profCode);
        
        echo "<pre>";
        var_dump($userid);
        var_dump($note);
        var_dump($etablissement->getProfId());
        echo "</pre>";
        
        
        $rating_property= new RatingProperty();
        $rating_property->setProfId($etablissement->getProfId());
        $rating_property->setUserId($userid);
        $rating_property->setRating1($note);

        $em->persist($rating_property);
        $em->flush();


        return $this->render('WCSRatingBundle::ratingProperty.html.twig', array(
        		'etablissement' => $etablissement,

        ));
    }
}
