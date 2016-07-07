<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userProf')
            ->add('userPrenom')
            ->add('userNom')
            ->add('userLangue')
            ->add('userAdd1')
            ->add('userAdd2')
            ->add('userCp')
            ->add('userVille')
            ->add('userTel')
            ->add('userMob')
            ->add('userDtNais', 'date')
            ->add('userDescriptif')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }
}
