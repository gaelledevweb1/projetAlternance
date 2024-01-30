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

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('streetName'
             , TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'streetName',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('StreetNumber'
             ,IntegerType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'StreetNumber',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('City'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'City',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ZIPCode'
             ,IntegerType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ZIPCode',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('Country'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'Country',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
        

        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class' =>   'btn btn-info'
            ],
            'label'=> 'create an Address'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' =>Address::class,
        ]);
    }
}
