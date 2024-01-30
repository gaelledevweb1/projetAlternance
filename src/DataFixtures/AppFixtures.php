<?php

namespace App\DataFixtures;



use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\Article;

use App\Entity\Category;


use App\Entity\Credentials;
use App\Entity\Order;
use App\Entity\Paiement;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // $users = [];

        // for ($i = 0; $i <= 99; $i++) {
            
        //     $user = new User();
        //     $user->setFirstName($faker->firstName());
        //     $user->setLastName($faker->lastName());
        //     $user->setPhoneNumber($faker->phoneNumber());
        //     $user->setRole("visiteur");
        //     $manager->persist($user);
        //     $users[] = $user;
        // }

       
        // $paiements = [];

        // for ($i = 0; $i <= 99; $i++) {
        //     $paiement = new Paiement();
        //     $paiement->setBankName($faker->word());

        //     $paiement->setCardName($faker->word());
        //     $paiement->setCardNumber($faker->creditCardNumber());
        //     $paiement->setCardNetwork($faker->creditCardType());
        //     $paiement->setCardHoldername($faker->word());
        //     $paiement->setExpirationDate($faker->creditCardExpirationDate());
        //     $paiement->setCVCCode($faker->randomNumber());
        //     $paiement->setSecurityCard($faker->numerify());
        //     $paiement->setCurrency($faker->word());




        //     $manager->persist($paiement);
        //     $paiements[] = $paiement;
        // }
        // $manager->flush();


        // $Categories = [];

        // for ($i = 0; $i <= 3; $i++) {
        //     $category = new Category();
        //     $category->setNameCategory($faker->word());
        //     $category->setCategoryImages($faker->word());
        //     $manager->persist($category);
        //     $Categories[] = $category;
        // }

        // $carts = [];
        // for ($i = 0; $i <= 15; $i++) {
        //     $cart = new Cart();

            
            
        //     $cart->setArticleQuantity($faker->randomDigit());
          
        //     $manager->persist($cart);
           
        //     $carts[] = $cart;
        // }

        // $manager->flush(); // Persist carts before adding articles


        // $Articles = [];
        // for ($i = 0; $i <= 15; $i++) {
        //     $article = new Article();
        //     // $article->setArticleRef($faker->randomElement());
        //     $article->setArticleRef
        //     ($faker->randomLetter());
        //     $article->setArticleName($faker->word());
        //     $article->setArticleImages($faker->imageUrl());
        //     $article->setArticleThumbnails($faker->imageUrl());
        //      $article->setArticleStockQuantity
        //     ($faker->randomDigit());
        //     // ($articleStockQuantity);correction non accepter
        //     $article->setArticleDescription($faker->text());
        //      $article->setBoughtPrice(29.97);
        //     // $article->setBoughtPrice($BoughtPrice); correction non accepter
        //     $article->setSellpriceHT(39.97);
        //     // $article->setSellPriceHT($sellPriceHT); correction non accepter
        //     $article->setSellPriceTTC(29.97 * 0.196 + 29.97);
        //     // $article->setSellPriceTTC($sellPriceTTC); correction non accepter
        //      $article->setTVA(0.196);
        //     //   $article->setTVA($tva); 
        //     //   correction non accepter
        //     $article->setDetails($faker->text());
            
        //     // $article->setCategories($Categories[$i]);
        //     //  $article->setCart($cart);
        //     // pourquoi tu n'as pas mis ceci.
            
        //     $manager->persist($article);
        //     $Articles[] = $article;
        // }
        // $manager->flush(); // Persist articles after they have been added to carts

        
        // $credential = [];
        // // $NCredentialses = $NUsers;

        // // for ($i = 0; $i <= $NCredentialses - 1; $i++) peux tu m'exliquer cette formule
        // for ($i = 0; $i <= 99; $i++) {
        //     $credentials = new Credentials();
        //     $credentials->setUserName($faker->userName());
        //     $credentials->setUserEmail($faker->email());
        //     $credentials->setPassword($faker->password());
        //     $credentials->setUser($users[$i]);
        //     $manager->persist($credentials);
        //     $credential[] = $credentials;
        // }

        // $addresses = [];
        // for ($i = 0; $i <= 99; $i++) {
        //     $address = new Address();
        //     $address->setStreetName($faker->streetName());
        //     $address->setStreetNumber($faker->randomDigit());
        //     $address->setCity($faker->city());
        //     $address->setZIPCode($faker->word());
        //     $address->setCountry($faker->country());
        //     $address->setUser($users[$i]);
        //     $manager->persist($address);
        //     $addresses[] = $address;
        // }

       




        // $orders = [];
        // for ($i = 0; $i <= 99; $i++) {
        //     $order = new order();
        //     $order->setOrderDate($faker->dateTime());
        //     $order->setPaid($faker->randomDigit(0,1));
        //     $order->setStatus($faker->word());
        //     $order->setDelivered($faker->randomDigit(0,1));
        //     $order->setDeliveryDate($faker->dateTime());
        //     $order->setDeliveryInfo($faker->text());
        //     $order->setUser($users[$i]);
        //     $manager->persist($order);
        //     $orders[] = $order;
        // }

        // $manager->flush();
    }
}


// pour la view rajouter ceci  $address->setUser($users[$i]);
// $article->setCategories($Categories[$i]);
// $credentials->setUser($users[$i]);
// $order->setUser($users[$i]);