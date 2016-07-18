<?php

namespace WCS\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\ContentBundle\Entity\Contenu;
use WCS\ContentBundle\Form\ContenuType;

/**
 * Contenu controller.
 *
 */
class ContenuController extends Controller
{
    /**
     * Lists all Contenu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contenus = $em->getRepository('WCSContentBundle:Contenu')->findAll();
        // $listerecus = $em->getRepository('AppBundle:Message')->findByIdDestinataire($iduser);

        $tab = [];

        foreach ($contenus as $contenu)
        {
            $userid = $em->getRepository('UserBundle:User')->findOneById($contenu->getContUserId());
            $username = $userid->getUserName();
            $tab[] = array(
                'prenom' => $userid->getUserPrenom(),
                'nom' => $userid->getUserNom(),
                'contenu' => $contenu->getContText(),
                'sujet' => $contenu->getContSujet(),
                'file' => $contenu->getContImgExt(),           
            );
        }

        return $this->render('WCSContentBundle:contenu:index.html.twig', array(
            'contenus' => $contenus,
            'tab'=> $tab,
        ));
    }

    /**
     * Creates a new Contenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $userid = $user->getId();
        $url = $request->getUri();
        $profId = preg_replace("/\D/",'', $url);


        $contenu = new Contenu();
        $form = $this->createForm('WCS\ContentBundle\Form\ContenuType', $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            echo('toto'); die; 

            $img = $contenu->getContImgExt();
            if ($img === null) {

            }
            else {
                // Generate a unique name for the file before saving it
                $imgName = md5(uniqid()).'.'.$img->guessExtension();
                

                // Move the file to the directory where files are stored
                $img->move(
                    $this->getParameter('img_directory'),
                    $imgName
                );

                // Update the 'file' property to store the PDF file name
                // instead of its contents
                $contenu->setContImgExt($imgName);
            }

            $contenu->setContUserId($userid);
            $contenu->setContProfId($profId);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contenu);
            $em->flush();

            return $this->redirectToRoute('contenu_show', array('id' => $contenu->getContId()));
        }

        return $this->render('WCSContentBundle:contenu:new.html.twig', array(
            'contenu' => $contenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contenu entity.
     *
     */
    public function showAction(Contenu $contenu)
    {
        $deleteForm = $this->createDeleteForm($contenu);

        return $this->render('WCSContentBundle:contenu:show.html.twig', array(
            'contenu' => $contenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contenu entity.
     *
     */
    public function editAction(Request $request, Contenu $contenu)
    {
        $deleteForm = $this->createDeleteForm($contenu);
        $editForm = $this->createForm('WCS\ContentBundle\Form\ContenuType', $contenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contenu);
            $em->flush();

            return $this->redirectToRoute('contenu_edit', array('id' => $contenu->getContId()));
        }

        return $this->render('WCSContentBundle:contenu:edit.html.twig', array(
            'contenu' => $contenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contenu entity.
     *
     */
    public function deleteAction(Request $request, Contenu $contenu)
    {
        $form = $this->createDeleteForm($contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contenu);
            $em->flush();
        }

        return $this->redirectToRoute('contenu_index');
    }

    /**
     * Creates a form to delete a Contenu entity.
     *
     * @param Contenu $contenu The Contenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contenu $contenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contenu_delete', array('id' => $contenu->getContId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
