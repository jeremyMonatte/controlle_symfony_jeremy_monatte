<?php

namespace App\Form;

use App\Entity\People;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeopleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, ['choices' => [
                'Civilités' => [
                    'Mme' => -1,
                    'M' => 1,
                    'Non binaire' => 0,
                ],
            ], 'required' => true,
                'attr' => [
                    'name' => "civilite",
                ],
            ])
            ->add('name', TextType::class, ['required' => true,
                'attr' => [
                    'placeholder' => 'Nom',
                    'id' => 'name',
                    'name' => "nom",
                ]]
            )
            ->add('prenom', TextType::class, ['required' => true,
                'attr' => [
                    'placeholder' => 'Prenom',
                    'id' => 'firstname',
                    'name' => "prenom",
                ]]
            )
            ->add('email', EmailType::class, ['required' => true,
                'attr' => [
                    'placeholder' => 'Email',
                    'id' => 'email',
                    'name' => "email",
                ]]
            )
            ->add('tel', TelType::class, ['required' => true,
                'attr' => [
                    'placeholder' => 'Telephone',
                    'id' => 'tel',
                    'name' => "tel",
                ]]
            )
            ->add('news', null, ['attr' => [
                'name'=> "news"
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => People::class,
        ]);
    }
}
