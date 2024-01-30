<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
 use 
 Symfony\Component\Form\Extension\Core\Type\IntegerType;
 use 
 Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('OrderDate'
        ,DateType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'OrderDate',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('Paid'
        ,IntegerType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'Paid',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
            ->add('Status'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'Status',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('Delivered'
        ,textType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'Delivered',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
            ->add('DeliveryDate'
        ,DateType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'DeliveryDate',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('DeliveryInfo'
        ,TextareaType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'DeliveryInfo',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )


            
            ->add('address', EntityType::class, [
                'class' => Address::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('cart', EntityType::class, [
                'class' => Cart::class,
'choice_label' => 'id',
            ])
        
        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class' =>   'btn btn-info'
            ],
            'label'=> 'create an order'
        ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
