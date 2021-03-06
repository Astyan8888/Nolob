<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('email')
          ->add('username')
          ->add('password', PasswordType::class)
          ->add('confirm_password', PasswordType::class)
          ->add('birthdate')
          ->add('Gender', ChoiceType::class, array(
                    'choices'  => array(
                        'Fille' => "0",
                        'Garçon' => "1",
                    )
                   )
                  )
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }
}
