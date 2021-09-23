<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\PostArt;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
               $post = new PostArt();
                $post->setTitle($faker->sentence($nbWords =2, $variableNbWords = true))
                ->setContent($faker->sentence($nbWords =10, $variableNbWords = true))
                ->setAuthor($faker->name())
                ->setCreatedAt($faker->dateTimeBetween('-6 months'));
                // $post->setTitle($faker->name)
                // ->setContent($faker->name)
                // ->setAuthor($faker->name)
                // ->setCreateAt($faker->DateTimeInterface);
           $manager->persist($post); 
        }
        $manager->flush();
    }
}