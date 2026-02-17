<?php

namespace App\Form;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Role\Role;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'invité',
            ])
            ->add('email', TextType::class, [
                'label' => 'Adresse mail',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('password', TextType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('roles', CollectionType::class, [
                'label' => 'Rôle',
                'entry_type' => ChoiceType::class,
                'entry_options'  => [
                    'choices'  => [
                        'Accès autorisé'        => 'ROLE_GUEST',
                        'Accès non-autorisé'    => 'ROLE_DISABLED',
                    ],
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'roles' =>  "ROLE_GUEST",
        ]);
    }
}
