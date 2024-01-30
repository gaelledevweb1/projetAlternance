<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\Credentials;
use App\Entity\Paiement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
 use 
 Symfony\Component\Form\Extension\Core\Type\IntegerType;
 use 
 Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ArticleRef'
             , TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ArticleRef',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ArticleName'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ArticleName',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ArticleImages'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ArticleImages',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ArticleThumbnails'
             ,TextType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ArticleThumbnails',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ArticleStockQuantity'
             ,IntegerType ::class, [
                 'attr'=>[
                     'class'=>'form-control'
                 ],
                 'label'=>'ArticleStockQuantity',
                 'label_attr'=>[
                     'class'=> 'form-label mt4'
                     ]
             ]
            )
            ->add('ArticleDescription'
            ,TextareaType ::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'ArticleDescription',
                'label_attr'=>[
                    'class'=> 'form-label mt4'
                    ]
            ]
           )
           
           ->add('BoughtPrice'
           ,NumberType ::class, [
               'attr'=>[
                   'class'=>'form-control'
               ],
               'label'=>'BoughtPrice',
               'label_attr'=>[
                   'class'=> 'form-label mt4'
                   ]
           ]
          )  

          ->add('SellpriceHT'
           ,NumberType ::class, [
               'attr'=>[
                   'class'=>'form-control'
               ],
               'label'=>'SellpriceHT',
               'label_attr'=>[
                   'class'=> 'form-label mt4'
                   ]
           ]
          )  

          ->add('SellPriceTTC'
           ,NumberType ::class, [
               'attr'=>[
                   'class'=>'form-control'
               ],
               'label'=>'SellPriceTTC',
               'label_attr'=>[
                   'class'=> 'form-label mt4'
                   ]
           ]
          )  

          ->add('TVA'
           ,NumberType ::class, [
               'attr'=>[
                   'class'=>'form-control'
               ],
               'label'=>'TVA',
               'label_attr'=>[
                   'class'=> 'form-label mt4'
                   ]
           ]
          )  
        
          ->add('Details'
          ,TextareaType ::class, [
              'attr'=>[
                  'class'=>'form-control'
              ],
              'label'=>'Details',
              'label_attr'=>[
                  'class'=> 'form-label mt4'
                  ]
          ]
         )

        //  ->add('Cart'
        //      , TextType ::class, [
        //          'attr'=>[
        //              'class'=>'form-control'
        //          ],
        //          'label'=>'Cart',
        //          'label_attr'=>[
        //              'class'=> 'form-label mt4'
        //              ]
        //      ]
        //     )

        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class' =>   'btn btn-info'
            ],
            'label'=> 'create an Article'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
