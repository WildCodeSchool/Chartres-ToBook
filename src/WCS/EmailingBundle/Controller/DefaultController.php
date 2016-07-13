<?php

namespace WCS\EmailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use WCS\EmailingBundle\Form\EmailUserListingType;

use WCS\EmailingBundle\Entity\EmailUserListing;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('WCSEmailingBundle:Default:index.html.twig');
    }

    // public function uploadCSVAction(Request $request)
    // {
    // 	// Getting php array of data from CSV
    //     // $fileName = '/var/www/html/Chartres-ToBook/web/uploads/csv/test1.csv';
    //     $converter = $this->container->get('import.csvtoarray');
    //     $tableau = $converter->convert($fileName, ',');

    //     return $tableau;
    // }

    public function importCSVAction(Request $request)
    {
        $csvFile = new EmailUserListing();
        $form = $this->createForm(EmailUserListingType::class, $csvFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $csvFile->getCsv();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('csv_directory'),
                $fileName
            );

			$path = $this->get('kernel')->getRootDir(). "/../web/uploads/csv/";

	        $converter = $this->container->get('import.csvtoarray');
	        $data = $converter->convert($path.$fileName, ',');

	        // Getting doctrine manager
	        $em = $this->getDoctrine()->getManager();
	        
	        // Define the size of record, the frequency for persisting the data and the current index of records
	        $size = count($data);
	        $batchSize = 20;
	        $i = 1;
	        
	        $now = new \DateTime(); 

	        // Processing on each row of data
	        foreach($data as $row) {
	 
	            $user = $em->getRepository('WCSEmailingBundle:EmailUserListing')
	                       ->findOneByEmail($row['email']);		

	            // If the user doest not exist we create one
	            if(!is_object($user)){
	                $user = new EmailUserListing();
	                $user->setEmail($row['email']);
	                $user->setNom($row['nom']);
		            $user->setPrenom($row['prenom']);
		            $user->setAddresse($row['adresse']);
		            $user->setVille($row['ville']);
		            $user->setPays($row['pays']);
		            $user->setGenre($row['genre']);
		            $user->setCsp($row['csp']);
		            $user->setDateUpload($now);
		            $user->setCsv($fileName);
	            }

				// Persisting the current user
	            $em->persist($user);
	            
				// Each 20 users persisted we flush everything
	            if (($i % $batchSize) === 0) {
	 
	                $em->flush();
					// Detaches all objects from Doctrine for memory save
	                $em->clear();
	            }
	 
	            $i++;
	 
	        }
			
			// Flushing and clear data on queue
	        $em->flush();
	        $em->clear();

            return $this->redirect($this->generateUrl('wcs_emailing_homepage'));
        }

        return $this->render('WCSEmailingBundle:Default:import.html.twig', array(
            'form' => $form->createView(),
        ));
    }
 
}