<?php

namespace App\Form;

use App\Entity\Cart;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('User'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'User',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('ArticleQuantity'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'ArticleQuantity',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )

        ->add('submit',SubmitType::class,[
                'attr'=>[
                    'class' =>   'btn btn-info'
                ],
                'label'=> 'create a cart'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cart::class,
        ]);
    }
}
