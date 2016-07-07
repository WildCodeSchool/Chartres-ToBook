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

        $address    = $request->query->get('address');
        $latitude   = $request->query->get('latitude');
        $longitude  = $request->query->get('longitude');
        $distance   = 10.5;

        $prix       = $request->query->get('prix');
        $etoiles    = $request->query->get('etoiles');
        $note       = $request->query->get('note');
        // var_dump($address);
        // var_dump($latitude);
        // var_dump($longitude);

        // switch ($prix) {
        //     case "asc":
        //         $order = array("profPrixMini" => "asc");
        //         break;
        //     case "desc":
        //         $order = array("profPrixMini" => "desc");
        //         break;
        // } 
        // switch ($etoiles) {
        //     case "asc":
        //         $order = array("profEtoiles" => "asc");
        //         break;
        //     case "desc":
        //         $order = array("profEtoiles" => "desc");
        //         break;
        // } 

        // switch ($note) {
        //     case "asc":
        //         $order = array("profId" => "asc");
        //         break;
        //     case "desc":
        //         $order = array("profId" => "desc");
        //         break;
        // }

        
        $d = $this->getDoctrine()->getRepository('WCSPropertyBundle:Professionnel')->createQueryBuilder('l');
        $d
            ->select('l')
            ->addSelect(
            '( 6371 * acos(cos(radians(' . $latitude . ')) * cos( radians( l.profLatitude ) ) * cos( radians( l.profLongitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( l.profLatitude ) ) ) ) as distance'
        )   ->where('l.profActif = :enabled')
            ->having('distance < :distance')
            ->orderBy('distance', 'ASC')
            ->setFirstResult(0)  
            ->setMaxResults(15)
            ->setParameter('enabled', 1)
            ->setParameter('distance', $distance);
        $query= $d->getQuery();
        $resultats= $query->getResult();


        var_dump($resultats);

        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'address'    => $address,
            'resultats' => $resultats,
        ));
    }  

}
