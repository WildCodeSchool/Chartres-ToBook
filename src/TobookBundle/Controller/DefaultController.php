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
    public function changeLocaleAction(Request $request)
    {
        $lg = $request->get('langue');
        $request = $this->getRequest();
        $request->setLocale($lg);
        return $this->redirect($this->generateUrl('tobook_homepage', array('_locale' => $lg)));
    }  
    public function searchAction(Request $request)
    {   
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');
        $prix = $request->query->get('prix');
        $etoiles = $request->query->get('etoiles');
        $note = $request->query->get('note');
        $order = array();
        switch ($prix) {
            case "asc":
                $order = array("profPrixMini" => "asc");
                break;
            case "desc":
                $order = array("profPrixMini" => "desc");
                break;
        } 
        switch ($etoiles) {
            case "asc":
                $order = array("profEtoiles" => "asc");
                break;
            case "desc":
                $order = array("profEtoiles" => "desc");
                break;
        } 
        switch ($note) {
            case "asc":
                $order = array("profId" => "asc");
                break;
            case "desc":
                $order = array("profId" => "desc");
                break;
        }
        // var_dump($order);
        
        $criteria = array();
        $repository = $this->getDoctrine()
            ->getRepository('WCSPropertyBundle:Professionnel');
        $resultats =  $repository->findBy($criteria, $order, 5, null);
        // $resultats =  $repository->findOneByProfId('1');
        // replace this example code with whatever you need
        return $this->render('TobookBundle:Default:search.html.twig', array(
            'base_dir'  => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'resultats' => $resultats,
        ));
    }  
}