<?php

namespace WCS\PropertyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\HttpFoundation\Response;

class ShowMapController extends Controller
{
    public function ShowMapAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {

            $latitude = $request->request->get('lat');
            $longitude = $request->request->get('lng');
            $radius = 10;
        
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('WCSPropertyBundle:Professionnel');

            $LatLng = $repository->getLatLng($latitude, $longitude, $radius);
            
            $resultat = $serializer->serialize( $LatLng, 'json');

            $response = new Response($resultat);

            $response->headers->set('Content-Type', 'application/json');

            return $response;

        }
    }
    
}
        

        
