<?php

namespace WCS\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function clubhouseAction(Request $request, $profCode)
    {
        $em = $this->getDoctrine()->getManager();

        $profId = preg_replace("/\D/",'', $profCode);

        $etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneByprofId($profId);
        $etablissement_etoile = $etablissement->getProfEtoiles();
        // echo ("<pre>");
        // var_dump($etablissement);
        // echo ("</pre>");

        $etablissement_img = $em->getRepository('WCSPropertyBundle:ProfImages')->findByprimProfId($profId);
        // echo ("<pre>");
        // var_dump($etablissement_img);
        // echo ("</pre>");

        return $this->render('WCSPropertyBundle::clubhouse.html.twig', array(
            'etablissement' => $etablissement, $etablissement_etoile, 'etablissement_img' => $etablissement_img,
        ));
    } 
}
