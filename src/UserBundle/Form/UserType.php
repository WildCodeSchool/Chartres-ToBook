<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userPrenom')
            ->add('userNom')
            ->add('userLangue', ChoiceType::class, array(
                'choices'  => array(
                    "fr" => 'Français',
                    "en" => 'English',
                    "de" => 'German',
                ),
            'multiple'  => false,
            'expanded'  => false,
            'required'  => false,
            ))
            ->add('userAdd1')
            ->add('userAdd2')
            ->add('userCp')
            ->add('userVille')
            ->add('userTel')
            ->add('userMob')
            ->add('userDtNais', null , array('widget' => 'single_text'))
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
