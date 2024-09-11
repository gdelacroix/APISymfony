<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [];

        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Category ' . $i)
                ->setDescription('Description for category ' . $i);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName('Product ' . $i)
                ->setDescription('Description for product ' . $i)
                ->setPrice(mt_rand(10, 100))
                ->setCategory($categories[array_rand($categories)]);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
