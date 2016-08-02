<?php

namespace WCS\PropertyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\PropertyBundle\Entity\Professionnel;
use WCS\PropertyBundle\Form\ProfessionnelType;
use UserBundle\Entity\UsersProfessionnel;
use UserBundle\Form\UsersProfessionnelType;
use WCS\PropertyBundle\Entity\ProfCate;

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
        //On créer un nouvel objet pour l'entité professionnel, ainsi qu'un autre pour chaque dépendance de ce dernier.
        $professionnel = new Professionnel();
        $usersprofessionnel = new UsersProfessionnel();
        $profCate = new ProfCate();

        $em = $this->getDoctrine()->getManager();
        $cate = $em->getRepository('WCSPropertyBundle:Categorie')->findAll();
        $form = $this->createForm('WCS\PropertyBundle\Form\ProfessionnelType', $professionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //L'établissement est crée avec le formulaire de création d'hotel accessible via les utilisateurs, il est donc actif.
            $professionnel->setProfActif(1);

            //On récupère la réponse de l'utilisateur concernant la catégorie de son établissement.
            $cateNom = $request->request->get('categorie');

            //Ici on récupère la catégorie correspondante au choix de l'utilisateur.
            $cateForm = $em->getRepository('WCSPropertyBundle:Categorie')->findOneByCateNom($cateNom);

            //Ici on récupère l'utilisateur actif.
            $user = $this->get('security.token_storage')->getToken()->getUser();

            $liste_etablissements = $em->getRepository('WCSPropertyBundle:Professionnel');

            //On récupère le ProfNom de l'établissement en cours de création afin de préparer la création du profCode
            $profNom = $professionnel->getProfNom();

            //On transforme le profNom pour retirer les accents et espaces grâce à la fonction présente plus bas
            $newProfNom = $this->createProfCode($profNom);

            //Ne pouvant pas récupérer l'id avant de créer l'entrée,
            //On ne peut pas créer le profCode (ProfNom+Id) on va donc procéder en deux temps
            //Tout d'abord on remplit le champs avec seulement le nom transformer (sans espaces/accents)
            $professionnel->setProfCode($newProfNom);

            //On remplit la table de lien usersprofessionnel
            $usersprofessionnel->setUsprDroits(0);
            $usersprofessionnel->setUsprUserId($user);
            $usersprofessionnel->setUsprProfId($professionnel);

            //On remplit la table de lien profCate
            $profCate->setPrcaCateId($cateForm);
            $profCate->setPrcaProfId($professionnel);

            //On enregistre tout en base
            $em->persist($professionnel);
            $em->persist($profCate);
            $em->persist($usersprofessionnel);
            
            $em->flush();

            //Une fois les entrées créés en base on va récupérer Professionnel pour modifier le profCode à l'aide de l'id
            $prof = $em->getRepository('WCSPropertyBundle:Professionnel')->findOneByProfCode($newProfNom);

            //On récupère l'id
            $profId = $prof->getId();

            //On récupère le profCode (qui ne contient pour l'instant que le nom)
            $profCode = $prof->getProfCode();

            //On créer le nouveau profCode (ancien+id)
            $newProfCode = $profCode.$profId;

            //On remplit le champs profCode
            $prof->setProfCode($newProfCode);

            //On enregistre en base
            $em->persist($professionnel);
            $em->flush();

            return $this->redirectToRoute('professionnel_show', array('id' => $professionnel->getId()));
        }

        return $this->render('WCSPropertyBundle:professionnel:new.html.twig', array(
            'professionnel' => $professionnel,
            'form' => $form->createView(),
            'cate' => $cate,
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

        $profId = $professionnel->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //On récupère les dépendances d'un établissement pour les supprimer également
            $userProf = $em->getRepository('UserBundle:UsersProfessionnel')->findOneByUsprProfId($profId);
            $profCate = $em->getRepository('WCSPropertyBundle:ProfCate')->findOneByPrcaProfId($profId);

            //On les supprimes
            $em->remove($userProf);
            $em->remove($profCate);
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

    public static function createProfCode($str) {

    $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '', ' ' => ''
    );

    // -- Remove duplicated spaces
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $str);

    // -- Returns the slug
    return strtolower(strtr($str, $table));
    }
}
