<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Customer;
use Exception;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $john = (new Customer())
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setEmail('john.doe@test.fr');

        $manager->persist($john);

        $susan = (new Customer())
            ->setFirstname('Susan')
            ->setLastname('Doyle')
            ->setEmail('susan.doyle@test.com');

        $manager->persist($susan);

        $product = (new Product())
            ->setName("Product 1")
            ->setCategory("Category 1")
            ->setOwner($john)
            ->setTags(['tag1', 'tag2']);

        $manager->persist($product);

        $product = (new Product())
            ->setName("Product 2")
            ->setCategory("Category 2")
            ->setOwner($john)
            ->setTags(['tag2', 'tag2', 'tag3']);

        $manager->persist($product);

        $product = (new Product())
            ->setName("Product 3")
            ->setCategory("Category 2")
            ->setOwner($susan)
            ->setTags(['tag3']);

        $manager->persist($product);
        
        $manager->flush();

        $customers = [];
        for ($i = 0; $i < 100 ; $i++) {
            $customer = (new Customer())
                ->setFirstname('CustomerFirstname' . $i)
                ->setLastname('CustomerLastname' . $i)
                ->setEmail('email' . $i . '@test.com');

            $manager->persist($customer);
            array_push($customers, $customer);
        }
        $manager->flush();

        for ($i = 0; $i < 1000 ; $i++) {
            $product = (new Product())
                ->setName("Product" . $i)
                ->setCategory("Category " . random_int(1, 10))
                ->setOwner($customers[random_int(0, 99)])
                ->setTags(['tag3']);

            $manager->persist($product);
        }
        $manager->flush();
    }
}
