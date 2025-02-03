<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $root = new Category();
        $root->setName('Root Category');
        $root->setPathSource('Root Category'); 
        $manager->persist($root);

        $child1 = new Category();
        $child1->setName('Child 1');
        $child1->setPathSource('Child 1'); 
        $child1->setParent($root);
        $manager->persist($child1);

        $child2 = new Category();
        $child2->setName('Child 2');
        $child2->setPathSource('Child 2'); 
        $child2->setParent($root);
        $manager->persist($child2);

        $subChild1 = new Category();
        $subChild1->setName('SubChild 1');
        $subChild1->setPathSource('SubChild 1'); 
        $subChild1->setParent($child1);
        $manager->persist($subChild1);

        $manager->flush();
    }
}