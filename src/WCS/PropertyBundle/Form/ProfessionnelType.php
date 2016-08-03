<?php

namespace WCS\PropertyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use WCS\PropertyBundle\Entity\Categorie;

class ProfessionnelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profNom')
            ->add('profEtoiles', ChoiceType::class, array(
                'choices'  => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                ),
            'multiple' => false,
            'expanded' => false,
            'required' => true,
        ))
            // ->add('profCateId', 'entity', 
            //     array('label' => 'Catégorie',
            //            'class' => 'WCSPropertyBundle:Categorie', 
            //            'property' => 'cateNom',
            //            'required' => true))
            ->add('profAdd1')
            ->add('profAdd2')
            ->add('profCp')
            ->add('profVille')
            ->add('profTel')
            ->add('profFax')
            ->add('profMail')
            ->add('profWeb')
            ->add('profWebResa')
            ->add('profLatitude')
            ->add('profLongitude')
            ->add('profPrixMini')
            ->add('profDescriptif')
            ->remove('profCapaPersonne')
            ->remove('profCapaChambre')
            ->remove('profCapaEmplacement')
            ->remove('profCapaHabitation')
            ->remove('profTemp')
            ->remove('profFormeJuri')
            ->remove('profAdd3')
            ->remove('profCode')
            ->remove('profActif')
        ;

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\PropertyBundle\Entity\Professionnel'
        ));
    }
}
