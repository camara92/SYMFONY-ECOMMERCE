<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
//nombre min de  caracteres :voir contraintes 

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('firstname', TextType::class, [
                'label'=>'Votre prénom',
               'constraints'=> new Length([
                   'min'=>2, 
                   'max'=>30
               ]),
                'attr'=>['placeholder'=>'Merci de saisir votre prénom']
                ]) 
            ->add('lastname', TextType::class, [
                'label'=>'Votre nom',
                'constraints'=> new Length([
                    'min'=>2, 
                    'max'=>45
                ]),
                'attr'=>['placeholder'=>'Merci de saisir votre nom']
                ])
            ->add('email', EmailType::class, [
                'label'=>'Votre adresse email ',
               'constraints'=> new Length([
                'min'=>2, 
                'max'=>90
            ]),
                'attr'=>['placeholder'=>'Merci de saisir votre email']
            ]) //input c'est comme demander d'ajouter 
            //->add('roles')
          
            ->add('password', RepeatedType::class,[

                
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doit être identique', 
                'label'=>'Confirmez votre mot de passe',
                
                'required'=> true, 
                'first_options'=>[
                'label'=>'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre mot de passe.']], 
                'second_options'=>['label'=>'Confirmez votre mot de passe',
                
                'attr'=>[
                    'placeholder'=>'Merci de confirmer votre mot de passe.']
                ]
                
                ])

            
            ->add('submiti', SubmitType::class,
            [
                'label'=>"S'inscrire",
            ] )
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}