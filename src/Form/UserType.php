<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\Credentials;
use App\Entity\Paiement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
 use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName'
             , TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'LastName',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('firstName'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'firstName',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('phoneNumber'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'phoneNumber',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            // ->add('role'
            //  ,TextType ::class, [
            //      'attr'=>[
            //          'class'=>'form-control'
            //      ],
            //      'label'=>'role',
            //      'label_attr'=>[
            //          'class'=> 'form-label mt4'
            //          ]
            //  ]
            // )
            
        

        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class' =>   'btn btn-info'
            ],
            'label'=> 'create a user'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
