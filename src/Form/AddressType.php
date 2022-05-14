<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Quel nom souhaitez-vous donner à votre adresse ?',
                'attr'=>[
                    'placeholder'=>'Nommer votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label'=>'Votre prénom?',
                'attr'=>[
                    'placeholder'=>'Entrer votre prénom'
                ]
                ])
            ->add('lastname', TextType::class, [
                'label'=>'Votre nom ?',
                'attr'=>[
                    'placeholder'=>'Entrer votre nom']
                ])
            ->add('company', TextType::class, [
                'label'=>'Quelle est le nom de votre société ?',
                'attr'=>[
                    'placeholder'=>'Entrer le nom de la société'
                ]
                ])
            ->add('adress', TextType::class, [
                'label'=>'Quel votre adresse actuelle ?',
                'attr'=>[
                    'placeholder'=>'14 Route de la Wantzenau...'
                ]
                ])
            ->add('postal', TextType::class, [
                'label'=>'Votre code postale ?',
                'attr'=>[
                    'placeholder'=>'67000'
                ]
                ])
            ->add('city', TextType::class, [
                'label'=>'Votre ville?',
                'attr'=>[
                    'placeholder'=>'Strasbourg'
                ]
                ])
            ->add('country', CountryType::class, [
                'label'=>'Votre pays ?',
                'attr'=>[
                    'placeholder'=>'France']
                ])
            ->add('phone', TelType::class, [
                'label'=>'Votre téléphone?',
                'attr'=>[
                    'placeholder'=>'0101020405']
                ])
            //->add('user')
            ->add('submit', SubmitType::class, [
                'label'=>'Valider',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
