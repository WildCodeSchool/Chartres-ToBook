<?php

namespace WCS\RatingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RatingPropertyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating1', ChoiceType::class, array(
                'choices'  => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                ),
                'label' => 'Premier Critère',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ))
            ->add('rating2', ChoiceType::class, array(
                'choices'  => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                ),
                'label' => 'Deuxième Critère',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ))
            ->add('rating3', ChoiceType::class, array(
                'choices'  => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                ),
                'label' => 'Troisième Critère',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ))
            ->remove('profId')
            ->remove('userId')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\RatingBundle\Entity\RatingProperty'
        ));
    }
}
