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

    public function changeLocaleAction(Request $request)
    {
        $lg = $request->get('langue');

        $request = $this->getRequest();
        $request->setLocale($lg);

        return $this->redirect($this->generateUrl('tobook_homepage', array('_locale' => $lg)));
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
            ->setMaxResults(2)
            ->setParameter('enabled', 1)
            ->setParameter('distance', $distance);
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
                        'id'=>$res[0]->getProfId(),
                        'distance'=>$res['distance'],
                        'lat'=>$res[0]->getProfLatitude(),
                        'lng'=>$res[0]->getProfLongitude(),
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
            'resultats' => $resultats,
        ));
    } 
}
