<?php

namespace WCS\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ContenuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contContId', 'hidden')
            ->remove('contSourceId')
            ->remove('contCibleId')
            ->remove('contSourceType')
            ->remove('contCibleType')
            ->remove('contDroits')
            ->remove('contActif')
            ->remove('contVisible')
            ->remove('contNature')
            ->remove('contDate', 'datetime')
            ->remove('contNote1')
            ->remove('contNote2')
            ->remove('contNote3')
            ->remove('contNote4')
            ->add('contSujet')
            ->add('contText')
            ->add('contImgExt', FileType::class, array('label' => 'Pièce jointe', 'required' => false))
            ->remove('contImgXy')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\ContentBundle\Entity\Contenu'
        ));
    }
}
