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

    public function redirectAction()
    {
        return $this->redirectToRoute('tobook_homepage', array(), 301);
    }

    // fonction permettant de récupérer la route actuelle en vue du changement de langue
    public function getRefererRoute()
    {
        $request = $this->getRequest();

        //récupère la route actuelle
        $referer = $request->headers->get('referer');
        $lastPath = substr($referer, strpos($referer, $request->getBaseUrl()));
        $lastPath = str_replace($request->getBaseUrl(), '', $lastPath);

        // récupère les informations du nom de la route (pas utile pour le besoin que l'on a)
        // $matcher = $this->get('router')->getMatcher();
        // $parameters = $matcher->match($lastPath);
        // $route = $parameters['_route'];

        return $lastPath;
    }

    // fonction permettant de changer la langue du site
    public function changeLocaleAction(Request $request)
    {
        $lg = $request->get('langue');

        // modifie la locale par la langue choisie dans la navbar
        $request = $this->getRequest();
        $request->setLocale($lg);

        // récupère la route actuelle afin 
        $route = $this->getRefererRoute();
        
        // permet de découper la route actuelle en différents items dans un tableau
        $pieces = explode("/", $route);
        // on change la valeur de la langue actuelle par la nouvelle sélectionnée
        $pieces[1]=$lg;
        //on recrée la route avec la langue nouvelle
        $newRoute = implode("/", $pieces);

        // on génère la nouvelle url
        // $url = 'http://localhost/Chartres-ToBook/web/app_dev.php'.$newRoute;
        $url = '..'.$newRoute;
        return $this->redirect($url);
    }  

    public function searchAction(Request $request)
    {   

        return $this->render('TobookBundle:Default:search.html.twig');
    }
}
