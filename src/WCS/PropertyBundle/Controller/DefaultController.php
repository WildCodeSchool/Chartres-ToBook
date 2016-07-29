<?php

namespace WCS\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{

    public function clubhouseAction(Request $request, $profCode)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();


        // permet de récupérer l'id de l'établissement écrit dans l'url après son nom (via une regex qui supprime les caractères non numériques)
        $profId = preg_replace("/\D/",'', $profCode);

        $etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneById($profId);
        // echo ("<pre>");
        // var_dump($etablissement);
        // echo ("</pre>");

        $etablissement_img = $em->getRepository('WCSPropertyBundle:ProfImages')->findByprimProfId($profId);
        // echo ("<pre>");
        // var_dump($etablissement_img);
        // echo ("</pre>");


        return $this->render('WCSPropertyBundle::clubhouse.html.twig', array(
            'etablissement' => $etablissement, 'etablissement_img' => $etablissement_img,
        ));
    } 

    public function favorisAction(Request $request, $profCode)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();


        // permet de récupérer l'id de l'établissement écrit dans l'url après son nom (via une regex qui supprime les caractères non numériques)
        $profId = preg_replace("/\D/",'', $profCode);

        $etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneById($profId);
        // echo ("<pre>");
        // var_dump($etablissement);
        // echo ("</pre>");

        $etablissement_img = $em->getRepository('WCSPropertyBundle:ProfImages')->findByprimProfId($profId);
        // echo ("<pre>");
        // var_dump($etablissement_img);
        // echo ("</pre>");

        $favoris = new UserListe();
        $userid = $user->getId();
        $favoris->setUsliUserId($userid);
        $favoris->setUsliProfId($profId);

        $em->persist($favoris);
        $em->flush();

        return $this->render('WCSPropertyBundle::clubhouse.html.twig', array(
            'etablissement' => $etablissement, 'etablissement_img' => $etablissement_img,
        ));
    } 
}
