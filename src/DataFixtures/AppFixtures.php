<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Customer;
use Adlarge\FixturesDocumentationBundle\Service\FixturesDocumentationManager;

class AppFixtures extends Fixture
{
    /**
      * @var FixturesDocumentationManager
    */
    private $documentationManager;

    /**
     * AppFixtures constructor.
     *
     * @param FixturesDocumentationManager $documentationManager
     */
    public function __construct(FixturesDocumentationManager $documentationManager)
    {
        $this->documentationManager = $documentationManager;
    }
    
    public function load(ObjectManager $manager)
    {
        $doc = $this->documentationManager->getDocumentation();
        
        $customer = (new Customer())
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setEmail('john.doe@test.fr');

        $manager->persist($customer);
        $manager->flush();
        $doc->addFixtureEntity($customer);

        $product = (new Product())
            ->setName("Product 1")
            ->setCategory("Category 1")
            ->setOwner($customer);

        $manager->persist($product);
        $manager->flush();
        $doc->addFixtureEntity($product);

        $product = (new Product())
            ->setName("Product 2")
            ->setCategory("Category 2")
            ->setOwner($customer);

        $manager->persist($product);
        $manager->flush();
        $doc->addFixtureEntity($product);

        
    }
}
