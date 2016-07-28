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

class ShowEtablissementController extends Controller
{
    public function EtablissementAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {

            $latitude = $request->request->get('lat');
            $longitude = $request->request->get('lng');
            $radius = 5;
        
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('WCSPropertyBundle:Professionnel');

            $Detail = $repository->getEtablissement($latitude, $longitude, $radius);
            
            $resultat = $serializer->serialize( $Detail, 'json');

            $response = new Response($resultat);

            $response->headers->set('Content-Type', 'application/json');
    
            return $response;

        }
    }
   
    public function SortingEtablissementAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {

            $latitude = $request->request->get('lat');
            $longitude = $request->request->get('lng');
            $radius = 5;
            $sorting = $request->request->get('prixmini');
            $direction = $request->request->get('direction');
        
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('WCSPropertyBundle:Professionnel');

            $Detail = $repository->getSortingEtablissement($latitude, $longitude, $radius, $sorting, $direction);
            
            $resultat = $serializer->serialize( $Detail, 'json');

            $response = new Response($resultat);

            $response->headers->set('Content-Type', 'application/json');
            
            return $response;

        }
    }
    
    public function StarEtablissementAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {

            $latitude = $request->request->get('lat');
            $longitude = $request->request->get('lng');
            $radius = 5;
            $star = $request->request->get('etoile');
            $direction = $request->request->get('direction');
        
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('WCSPropertyBundle:Professionnel');

            $Detail = $repository->getStarEtablissement($latitude, $longitude, $radius, $star, $direction);
            
            $resultat = $serializer->serialize( $Detail, 'json');

            $response = new Response($resultat);

            $response->headers->set('Content-Type', 'application/json');
            
            return $response;

        }
    }
    
}