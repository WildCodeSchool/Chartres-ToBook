<?php

namespace WCS\PropertyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MergedFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('professionnel', new ProfessionnelType());
        $builder->add('profimg',  new ProfImagesType());
    }
    
    // /**
    //  * @param OptionsResolver $resolver
    //  */
    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'WCS\PropertyBundle\Entity\ProfImages'
    //     ));
    // }
}
