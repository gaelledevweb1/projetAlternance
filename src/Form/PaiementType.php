<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\Paiement;
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

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('BankName'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'BankName',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('CardName'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'CardName',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
            ->add('CardNumber'
        ,IntegerType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'CardNumber',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('CardNetwork'
        ,textType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'CardNetwork',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
            ->add('CardHoldername'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'CardHoldername',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('ExpirationDate'
        ,DateType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'ExpirationDate',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )

            ->add('CVCCode'
            ,integerType ::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'CVCCode',
                'label_attr'=>[
                    'class'=> 'form-label mt4'
                    ]
            ]
                )
            
            ->add('SecurityCard'
            ,TextType ::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'SecurityCard',
                'label_attr'=>[
                    'class'=> 'form-label mt4'
                    ]
            ]
                )

                ->add('Currency'
            ,TextType ::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Currency',
                'label_attr'=>[
                    'class'=> 'form-label mt4'
                    ]
            ]
                )
            

            
            ->add('cart', EntityType::class, [
                'class' => Cart::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        
        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class' =>   'btn btn-info'
            ],
            'label'=> 'create a paiement'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}
