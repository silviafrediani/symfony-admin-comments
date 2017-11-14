<?php

namespace CaffeOlivuzzo\AdminBundle\Form;

use CaffeOlivuzzo\AdminBundle\Entity\FotoClienti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FotoClientiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foto', FileType::class, array(
                'data_class' => null,
                'required'  => false,
            ))
            ->add('testoAlternativo', TextType::class)
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
            'data_class' => FotoClienti::class,
        ));
    }
}
