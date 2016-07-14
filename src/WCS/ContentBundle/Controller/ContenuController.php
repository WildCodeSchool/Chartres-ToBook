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

        return $this->render('WCSContentBundle:contenu:index.html.twig', array(
            'contenus' => $contenus,
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

        $contenu = new Contenu();
        $form = $this->createForm('WCS\ContentBundle\Form\ContenuType', $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contenu->setContUserId($userid);
            $contenu->setContProfId(1);
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
