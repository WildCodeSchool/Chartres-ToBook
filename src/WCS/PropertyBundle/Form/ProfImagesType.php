<?php

namespace WCS\PropertyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfImagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('primDefaut')
            ->remove('primOrd')
            ->remove('primExt')
            ->remove('primNom')
            ->remove('primXy')
            ->add('primImgUrl', FileType::class, array('label' => 'Image établissement'))
            ->remove('primProfId')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\PropertyBundle\Entity\ProfImages'
        ));
    }
}
