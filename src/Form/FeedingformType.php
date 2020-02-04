<?php

namespace App\Form;

use App\Entity\Feeding;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FeedingformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('datefeeding')
            ->add('amount')
            ->add('duration')
            ->add('breast', ChoiceType::class, array(
                    'choices'  => array(
                        'Aucun'=> "0",
                        'Droit' => "1",
                        'Gauche' => "2",
                    )
                   )
                  )
                ;
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feeding::class,
        ]);
    }
}
