<?php

namespace WCS\PropertyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\PropertyBundle\Entity\Professionnel;
use WCS\PropertyBundle\Form\ProfessionnelType;
use UserBundle\Entity\UsersProfessionnel;
use UserBundle\Form\UsersProfessionnelType;

/**
 * Professionnel controller.
 *
 */
class ProfessionnelController extends Controller
{
    /**
     * Lists all Professionnel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $professionnels = $em->getRepository('WCSPropertyBundle:Professionnel')->findAll();

        return $this->render('WCSPropertyBundle:professionnel:index.html.twig', array(
            'professionnels' => $professionnels,
        ));
    }

    /**
     * Creates a new Professionnel entity.
     *
     */
    public function newAction(Request $request)
    {
        $professionnel = new Professionnel();
        $form = $this->createForm('WCS\PropertyBundle\Form\ProfessionnelType', $professionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $professionnel->setProfActif(1);


            $usersprofessionnel = new UsersProfessionnel();

            $userId = $this->get('security.token_storage')->getToken()->getUser();
            $liste_etablissements = $em->getRepository('WCSPropertyBundle:Professionnel');

            $usersprofessionnel->setUsprDroits(0);
            $usersprofessionnel->setUsprUserId($userId);
            $usersprofessionnel->setUsprProfId($professionnel);

            $em->persist($professionnel);
            $em->persist($usersprofessionnel);

            $em->flush();

            return $this->redirectToRoute('professionnel_show', array('id' => $professionnel->getprofId()));
        }

        return $this->render('WCSPropertyBundle:professionnel:new.html.twig', array(
            'professionnel' => $professionnel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Professionnel entity.
     *
     */
    public function showAction(Professionnel $professionnel)
    {
        $deleteForm = $this->createDeleteForm($professionnel);

        return $this->render('WCSPropertyBundle:professionnel:show.html.twig', array(
            'professionnel' => $professionnel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Professionnel entity.
     *
     */
    public function editAction(Request $request, Professionnel $professionnel)
    {
        $deleteForm = $this->createDeleteForm($professionnel);
        $editForm = $this->createForm('WCS\PropertyBundle\Form\ProfessionnelType', $professionnel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($professionnel);
            $em->flush();

            return $this->redirectToRoute('professionnel_edit', array('id' => $professionnel->getId()));
        }

        return $this->render('WCSPropertyBundle:professionnel:edit.html.twig', array(
            'professionnel' => $professionnel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Professionnel entity.
     *
     */
    public function deleteAction(Request $request, Professionnel $professionnel)
    {
        $form = $this->createDeleteForm($professionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($professionnel);
            $em->flush();
        }

        return $this->redirectToRoute('professionnel_index');
    }

    /**
     * Creates a form to delete a Professionnel entity.
     *
     * @param Professionnel $professionnel The Professionnel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Professionnel $professionnel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('professionnel_delete', array('id' => $professionnel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
