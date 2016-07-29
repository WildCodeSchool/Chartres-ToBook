<?php

namespace WCS\EmailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use WCS\EmailingBundle\Form\EmailUserListingType;
use Symfony\Component\HttpFoundation\Session\Session;

use WCS\EmailingBundle\Entity\EmailUserListing;

class DefaultController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();

		$liste_etablissements = $em->getRepository('UserBundle:UsersProfessionnel')->findByUsprUserId($userId);
		// echo('<pre>');
		// var_dump($liste_etablissements);
		// echo('</pre>');
		$client = $em->getRepository('WCSEmailingBundle:EmailUserListing')->findByemaiUserId($userId);
		// echo('<pre>');
		// var_dump($client);
		// echo('</pre>');
        
        $form = $this->createForm(EmailUserListingType::class);

        return $this->render('WCSEmailingBundle:Default:emailing.html.twig', array(
        	'form' => $form->createView(),
            'liste_etablissements' => $liste_etablissements,
            'client' => $client,
        ));
    }

    // Controleur gérant la vue d'import de fichier csv
    public function importCSVAction(Request $request, $profCode)
    {

        $CSVFile = new EmailUserListing();
        $form = $this->createForm(EmailUserListingType::class, $CSVFile);
        $form->handleRequest($request);

        // $file stocke le fichier uploadé
        $file = $CSVFile->getEmaiCSVFile();

        // Création d'un nom unique pour le fichier avant l'écriture
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // Déplacement du fichier vers le dossier
        $file->move(
            $this->getParameter('csv_directory'),
            $fileName
        );

		// Récupération du chemin où est stocké le fichier uploadé
		$path = $this->get('kernel')->getRootDir(). "/../web/uploads/csv/";

        // Lancement du service de conversion csv vers array
        $converter = $this->container->get('import.csvtoarray');
        $data = $converter->convert($path.$fileName, ',');

        $em = $this->getDoctrine()->getManager();
        
        // Define the size of record, the frequency for persisting the data and the current index of records
        $size = count($data);
        $batchSize = 20;
        $i = 1;
        
        $now = new \DateTime(); 

		// permet de récupérer l'id de l'établissement écrit dans l'url après son nom (via une regex qui supprime les caractères non numériques)
		$profId = preg_replace("/\D/",'', $profCode);
		// récupère l'établissement pour lequel l'upload du csv se fait
		$etablissement = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneById($profId);
		// récupère l'id du pro
		$userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
		// var_dump($userId);die;

        // Traitement de chaque ligne du fichier
        foreach($data as $row) {
 
            // $customer = $em->getRepository('WCSEmailingBundle:EmailUserListing')
            //            ->findOneByemaiEmail($row['email']);
            $customerCheck = $em->getRepository('WCSEmailingBundle:EmailUserListing')
                       ->findBy(array('emaiEmail' => $row['email'], 'emaiUserId' => $userId, 'emaiProfId' => $etablissement ));

            // If the customer does not exist we create one
            if(empty($customerCheck)){
                $customer = new EmailUserListing();
                $customer->setEmaiEmail($row['email']);
                $customer->setEmaiNom($row['nom']);
	            $customer->setEmaiPrenom($row['prenom']);
	            $customer->setEmaiAdresse($row['adresse']);
	            $customer->setEmaiVille($row['ville']);
	            $customer->setEmaiPays($row['pays']);
	            $customer->setEmaiGenre($row['genre']);
	            $customer->setEmaiCSP($row['csp']);
	            $customer->setEmaiDateUpload($now);
	            $customer->setEmaiCSVFile($fileName);
	            $customer->setEmaiUserId($this->get('security.token_storage')->getToken()->getUser());
	            $customer->setEmaiProfId($etablissement);

	            // Persisting the current customer
            	$em->persist($customer);
            }
            
			// Each 20 users persisted we flush everything
            if (($i % $batchSize) === 0) {
 
                $em->flush();
				// Detaches all objects from Doctrine for memory save
                $em->clear();
            }
 
            $i++;
 
        }
		
        $em->flush();
        $em->clear();

        // décommenter les trois lignes ci-dessous si vous voulez supprimer le fichier du serveur après import
        // if(file_exists($path.$fileName)){
        // 	unlink($path.$fileName);
        // }

        return $this->redirect($this->generateUrl('wcs_emailing_homepage'));
    }

    public function sendmailAction(request $request)
	{
		// new session pour flashbag
        $session = new Session();
		$em = $this->getDoctrine()->getManager();

		//On récupère les inputs de la vue
        $message = $request->request->get('message');
        $sujet = $request->request->get('sujet');
        $destinataire = $request->request->get('destinataire');

        //On convertit le string que nous retourne l'input destinataire en un tableau contenant chaque adresse mail
		$dest = explode(',', $destinataire);

		//On utilise chaque champ précédemment 
	    $message = \Swift_Message::newInstance()
	        ->setSubject($sujet)
            ->setFrom("clubtobook@gmail.com")
	        ->setTo($dest)
	        ->setBody($message);
	    $this->get('mailer')->send($message);

	    $session->getFlashBag()->add('infos', $this->get('translator')->trans('Mail(s) envoyé(s)'));

	    return $this->redirect($this->generateUrl('wcs_emailing_homepage'));
	}

	// fonction de suppression de référence clients
    public function supprAction($idClient)
    {
        // new session pour flashbag
        $session = new Session();
        
        $em = $this->getDoctrine()->getEntityManager();

        $clients = explode(',', $idClient);

        foreach($clients as $client) {

            $emailClient = $em->getRepository('WCSEmailingBundle:EmailUserListing')->findOneById($client);

            $em->remove($emailClient);
        }

        $em->flush();

        $session->getFlashBag()->add('infos', $this->get('translator')->trans('Client(s) supprimé(s)'));

        return $this->redirect($this->generateUrl('wcs_emailing_homepage'));
    }
 
}