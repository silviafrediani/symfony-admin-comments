<?php

namespace CaffeOlivuzzo\AdminBundle\Form;

use CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommentiClientiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeCognome', TextType::class)
            ->add('commento', TextareaType::class)
            ->add('approvato', ChoiceType::class, array(
                'choices'   => array('No' => '0', 'Sì' => '1'),
                'required'  => false,
                ))
            ->add('data', DateTimeType::class, array(
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                        'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                    )
                ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CommentiClienti::class,
        ));
    }
}
