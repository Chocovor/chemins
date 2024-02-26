<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersCrudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surname')
            ->add('firstname')
            ->add('nickname')
            ->add('mail')
            ->add('password')
            ->add('birthday')
            ->add('address')
            ->add('postalcode')
            ->add('city')
            ->add('phonenumber')
            ->add('description')
            ->add('createdat')
            ->add('role')
            ->add('eventsparticipation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
