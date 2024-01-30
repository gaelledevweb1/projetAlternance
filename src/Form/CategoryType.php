<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('NameCategory'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'NameCategory',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )
        
        ->add('CategoryImages'
        ,TextType ::class, [
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'CategoryImages',
            'label_attr'=>[
                'class'=> 'form-label mt4'
                ]
        ]
            )

        ->add('submit',SubmitType::class,[
                'attr'=>[
                    'class' =>   'btn btn-info'
                ],
                'label'=> 'create a category'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
