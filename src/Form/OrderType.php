<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {  // dd($options);
        $user =$options['user'];
        $builder
            ->add('addresses', EntityType::class,
            [
                'label'=> 'Choisissez votre adersse de livraion :',
                'required'=>true,
                'class'=> Adress::class,
                'choices'=>$user->getAdresses(),
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('carriers', EntityType::class,
                [
                    'label'=> 'Choisissez votre moyen de transport :',
                    'required'=>true,
                    'class'=> Carrier::class,
                    'multiple'=>false,
                    'expanded'=>true
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user'=> array()
            // Configure your form options here
        ]);
    }
}
