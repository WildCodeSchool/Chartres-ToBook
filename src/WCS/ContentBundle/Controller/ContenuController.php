<?php

namespace WCS\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\ContentBundle\Entity\Contenu;
use WCS\ContentBundle\Entity\Professionnel;
use WCS\ContentBundle\Form\ContenuType;

/**
 * Contenu controller.
 *
 */
class ContenuController extends Controller
{


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
    /**
     * Lists all Contenu entities.
     *
     */
    public function indexAction(Request $request, $profCode)
    {
        $em = $this->getDoctrine()->getManager();

        $profId = preg_replace("/\D/",'', $profCode);

        // $contenus = $em->getRepository('WCSContentBundle:Contenu')->findByContProfId($profId);
        $contenus = $em->getRepository('WCSContentBundle:Contenu')->findBy(array('contProfId'=>$profId, 'contContId'=>null), array('contId'=>'desc'));

        // $tab = [];

        // foreach ($contenus as $contenu)
        // {   

        //     $userid = $em->getRepository('UserBundle:User')->findOneById($contenu->getContUserId());
        //     if (empty($userid)) {
        //         $prenom = "utilisateur";
        //         $nom    = "anonyme";
        //     } else {
        //         $prenom = $userid->getUserPrenom();
        //         $nom    = $userid->getUserNom();
        //     }
            
        //     $tab[] = array(
        //         'id'        => $contenu ->getContId(),
        //         'cont_id'   => $contenu ->getContContId(),
        //         'prenom'    => $prenom,
        //         'nom'       => $nom,
        //         'contenu'   => $contenu->getContText(),
        //         'sujet'     => $contenu->getContSujet(),
        //         'file'      => $contenu->getContImgExt(),
        //         'date'      => $contenu->getContDate(),
        //         'childs'    => $this->getChildComment($profId, $contenu ->getContId()),
        //     );
            
        // }

        $tab = $this->getChildComment($profId, null);
        // dump($tab);
        
        return $this->render('WCSContentBundle:contenu:index.html.twig', array(
            'tab'=> $tab,
        ));
    }

    /**
     * Request childs Comments.
     *
     */
    public function getChildComment($profId, $idParent)
    {
        // dump($profId, $idParent);
        $em = $this->getDoctrine()->getManager();
        $commentaires = $em->getRepository('WCSContentBundle:Contenu')->findBy(array('contProfId'=>$profId, 'contContId'=>$idParent), array('contId'=>'asc'));

        $comm_tab =[];
        
        foreach ($commentaires as $commentaire) {
            $userid = $em->getRepository('UserBundle:User')->findOneById($commentaire->getContUserId());
            if (empty($userid)) {
                $prenom = "utilisateur";
                $nom    = "anonyme";
            } else {
                $prenom = $userid->getUserPrenom();
                $nom    = $userid->getUserNom();
            }
            
            $comm_tab[] = array(
                'id'        => $commentaire ->getContId(),
                'cont_id'   => $commentaire ->getContContId(),
                'prenom'    => $prenom,
                'nom'       => $nom,
                'contenu'   => $commentaire->getContText(),
                'sujet'     => $commentaire->getContSujet(),
                'file'      => $commentaire->getContImgExt(),
                'date'      => $commentaire->getContDate(),
                'childs'    => $this->getChildComment($profId, $commentaire ->getContId()),
            );            
        }
        return $comm_tab;


    }

    /**
     * Creates a new Contenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $route = $this->getRefererRoute();
        $profId = preg_replace("/\D/",'', $route);

        $contenu = new Contenu();
        $form = $this->createForm('WCS\ContentBundle\Form\ContenuType', $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->container->get('security.context')->getToken()->getUser();
            $userid = $user->getId();
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
            $contenu->setContDate(new \Datetime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($contenu);
            $em->flush();

            $url = '..'.$route;

            return $this->redirect($url);
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
