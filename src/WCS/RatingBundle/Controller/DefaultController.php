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
    	// On récupère l'objet user
        $user = $this->container->get('security.context')->getToken()->getUser();
        // on récupère l'objet établissemnt
        $etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneByprofCode($profCode);
        // on récupère la note
        $note1 = $request->query->get('note1');
        $note2 = $request->query->get('note2');
        $note3 = $request->query->get('note3');
        
        $notations = $em->getRepository('WCSRatingBundle:RatingProperty')
        	->findBy(array('userId'=>$user->getId(), 'profId'=>$etablissement->getProfId()));

        // On compte le nombre de notation de cet user pour cet etablissement
        $compte = count($notations);
        
        // Si 0 notation, on en crée une
        if ( count($notations) == 0 ) {
        	dump("Il n'y a pas de notation pour cette propriété et cet utilisateur");
	        $notation= new RatingProperty();
	        $notation->setProfId($etablissement);
	        $notation->setUserId($user);
	        $notation->setRating1($note1);
	        $notation->setRating2($note2);
	        $notation->setRating3($note3);
        	$em->persist($notation);
        	$em->flush();
        
        // Si 1 notation, on en la met à jour
        } elseif (count($notations) == 1) {
        	dump("Il y a 1 notation pour cette propriété et cet utilisateur");
	        $notations[0]->setRating1($note1);
	        $notations[0]->setRating2($note2);
	        $notations[0]->setRating3($note3);
        	$em->persist($notations[0]);
        	$em->flush();

        // Sinon, ça sentiré le paté si ca devait arriver
        } else {
        	// erreur il y a plusieur notes déposées par cette utilisateur pour cet établissement
        }

        return $this->render('WCSRatingBundle::ratingProperty.html.twig', array(
        		'etablissement' => $etablissement,


        ));
    }
}
