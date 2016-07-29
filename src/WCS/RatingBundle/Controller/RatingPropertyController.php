<?php

namespace WCS\RatingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\RatingBundle\Entity\RatingProperty;
use WCS\RatingBundle\Form\RatingPropertyType;

/**
 * RatingProperty controller.
 *
 */
class RatingPropertyController extends Controller
{
    /**
     * Lists all RatingProperty entities.
     *
     */
    public function indexAction(Request $request, $profCode)
    {
        $em = $this->getDoctrine()->getManager();

        $profId = preg_replace("/\D/",'', $profCode);

        $property = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneById($profId);

        $ratingProperties = $em->getRepository('WCSRatingBundle:RatingProperty')->findBy(array('profId'=>$property->getId()));

            $howManyProperties = count($ratingProperties);
            $totalnote=0;
            if ($howManyProperties == 0) {
                $moyenneTotal="Il n'y a pas de vote sur cet établissement";
            }

            elseif ($howManyProperties < 3) {
                $moyenneTotal="Il n'y a pas assez de vote sur cet établissement";
            }
            else {
                foreach ($ratingProperties as $ratingProperty) {

                    $note1=$ratingProperty->getRating1();
                    $note2=$ratingProperty->getRating2();
                    $note3=$ratingProperty->getRating3();
                    $sommenote=$note1+$note2+$note3;
                    $totalnote+=$sommenote;    
                }
                $moyenneTotal=$totalnote/($howManyProperties*3);
            }
        

        return $this->render('WCSRatingBundle:ratingproperty:index.html.twig', array(
            'ratingProperties' => $ratingProperties,
            'moyenneTotal' => $moyenneTotal,
        ));
    }

    /**
     * Creates a new RatingProperty entity.
     *
     */
    public function newAction(Request $request, $profCode)
    {   

        $em = $this->getDoctrine()->getManager();

        // permet de récupérer l'id de l'établissement écrit dans l'url après son nom (via une regex qui supprime les caractères non numériques)
        $profId = preg_replace("/\D/",'', $profCode);

        // récupère l'user actuel
        $user = $this->container->get('security.context')->getToken()->getUser();

        $property = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneById($profId);

        // récupère les votes existants pour un utilsateur
        $notations = $em->getRepository('WCSRatingBundle:RatingProperty')->findBy(array('userId'=>$user->getId(), 'profId'=>$property->getId()));


        $ratingProperty = new RatingProperty();
        $form = $this->createForm('WCS\RatingBundle\Form\RatingPropertyType', $ratingProperty);
        $form->handleRequest($request);

        //Cette condition sert à vérifier que l'utilisateur n'ai pas déjà voté pour cet établissement
        if ( count($notations) == 0 )  {
            if ($form->isSubmitted() && $form->isValid()) {
                $ratingProperty->setProfId($property);
                $ratingProperty->setUserId($user);
                $em->persist($ratingProperty);
                $em->flush();

                return $this->redirectToRoute('club-house', array('profCode' => $profCode));
            }
        }
        else {
            if ($form->isSubmitted() && $form->isValid()) {
                $em->remove($notations[0]);
                $em->flush();
                $ratingProperty->setProfId($property);
                $ratingProperty->setUserId($user);
                $em->persist($ratingProperty);
                $em->flush();

                return $this->redirectToRoute('club-house', array('profCode' => $profCode));
            }  
        }

        return $this->render('WCSRatingBundle:ratingproperty:new.html.twig', array(
            'ratingProperty' => $ratingProperty,
            'form' => $form->createView(),
            'profCode'=> $profCode,
        ));
    }

    /**
     * Finds and displays a RatingProperty entity.
     *
     */
    public function showAction(Request $request, $ProfCode, RatingProperty $ratingProperty)
    {
        $deleteForm = $this->createDeleteForm($ratingProperty);

        return $this->render('WCSRatingBundle:ratingproperty:show.html.twig', array(
            'ratingProperty' => $ratingProperty,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RatingProperty entity.
     *
     */
    public function editAction(Request $request, RatingProperty $ratingProperty)
    {
        $deleteForm = $this->createDeleteForm($ratingProperty);
        $editForm = $this->createForm('WCS\RatingBundle\Form\RatingPropertyType', $ratingProperty);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ratingProperty);
            $em->flush();

            return $this->redirectToRoute('ratingproperty_edit', array('id' => $ratingProperty->getId()));
        }

        return $this->render('WCSRatingBundle:ratingproperty:edit.html.twig', array(
            'ratingProperty' => $ratingProperty,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RatingProperty entity.
     *
     */
    public function deleteAction(Request $request, RatingProperty $ratingProperty)
    {
        $form = $this->createDeleteForm($ratingProperty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ratingProperty);
            $em->flush();
        }

        return $this->redirectToRoute('ratingproperty_index');
    }

    /**
     * Creates a form to delete a RatingProperty entity.
     *
     * @param RatingProperty $ratingProperty The RatingProperty entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RatingProperty $ratingProperty)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ratingproperty_delete', array('id' => $ratingProperty->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
