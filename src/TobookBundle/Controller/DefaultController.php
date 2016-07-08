<?php

namespace TobookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use WCS\PropertyBundle\Entity\Professionnel;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TobookBundle:Default:index.html.twig');
    }

    public function searchAction(Request $request)
    {   

        $distance   = 50;
        $address    = $request->query->get('address');
        $latitude   = $request->query->get('latitude');
        $longitude  = $request->query->get('longitude');

        $prix       = $request->query->get('prix');
        $etoiles    = $request->query->get('etoiles');
        $note       = $request->query->get('note');

        $d = $this->getDoctrine()->getRepository('WCSPropertyBundle:Professionnel')->createQueryBuilder('p');
        $d
            ->select('p')
            ->addSelect(
            '( 6371 * acos(cos(radians( :latitude )) * cos( radians( p.profLatitude ) ) * cos( radians( p.profLongitude ) - radians( :longitude) ) + sin( radians( :latitude ) ) * sin( radians( p.profLatitude ) ) ) ) as distance'
        )   ->where('p.profActif = :enabled')
            ->having('distance < :distance')
            ->orderBy('distance', 'ASC')
            ->setFirstResult(0)  
            ->setMaxResults(15)
            ->setParameter('latitude', $latitude)
            ->setParameter('longitude', $longitude)
            ->setParameter('distance', $distance)
            ->setParameter('enabled', 1);
        $query= $d->getQuery();
        $resultats= $query->getResult();

        // var_dump($resultats);

        $tab_resultats = [];
        if (!empty($resultats))
        {
            foreach ($resultats as $res)
            {   
                $tab_res = [];
                $tab_res[] = array(
                        'distance'=>$res['distance'],
                        'id'    =>$res[0]->getProfId(),
                        'lat'   =>$res[0]->getProfLatitude(),
                        'lng'   =>$res[0]->getProfLongitude(),
                        'lng'   =>$res[0]->getProfLongitude(),
                        'profNom'           =>$res[0]->getProfNom(),
                        'profDescriptif'    =>$res[0]->getProfDescriptif(),
                        'profPrixMini'      =>$res[0]->getProfPrixMini(),
                        'profEtoiles'       =>$res[0]->getProfEtoiles(),
                    );
                array_push($tab_resultats, $tab_res);
            }
        }        


        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'address'    => $address,
            'resultats' => $tab_resultats,
        ));
    }

public function jsonNearbyAction(Request $request)
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

        $d = $this->getDoctrine()->getRepository('WCSPropertyBundle:Professionnel')->createQueryBuilder('p');
        $d
            ->select('p')
            ->addSelect(
            '( 6371 * acos(cos(radians( :latitude )) * cos( radians( p.profLatitude ) ) * cos( radians( p.profLongitude ) - radians( :longitude) ) + sin( radians( :latitude ) ) * sin( radians( p.profLatitude ) ) ) ) as distance'
        )   ->where('p.profActif = :enabled')
            ->having('distance < :distance')
            ->orderBy('distance', 'ASC')
            ->setFirstResult(0)  
            ->setMaxResults(15)
            ->setParameter('latitude', $latitude)
            ->setParameter('longitude', $longitude)
            ->setParameter('distance', $distance)
            ->setParameter('enabled', 1);
        $query= $d->getQuery();
        $resultats= $query->getResult();

        // var_dump($resultats);

        $tab_resultats = [];
        if (!empty($resultats))
        {
            foreach ($resultats as $res)
            {   
                $tab_res = [];
                $tab_res[] = array(
                        'distance'=>$res['distance'],
                        'id'    =>$res[0]->getProfId(),
                        'lat'   =>$res[0]->getProfLatitude(),
                        'lng'   =>$res[0]->getProfLongitude(),
                        'lng'   =>$res[0]->getProfLongitude(),
                        'profNom'           =>$res[0]->getProfNom(),
                        'profDescriptif'    =>$res[0]->getProfDescriptif(),
                        'profPrixMini'      =>$res[0]->getProfPrixMini(),
                        'profEtoiles'       =>$res[0]->getProfEtoiles(),

                    );
                array_push($tab_resultats, $tab_res);
            }
        }        
        // var_dump($tab_resultats);
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $result = $serializer->serialize( $tab_resultats, 'json');
        var_dump($result);         

        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'address'    => $address,
            'resultats' => $tab_resultats,
        ));
    }  

}
