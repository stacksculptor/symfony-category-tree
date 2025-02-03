<?php

namespace App\Tests;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testSetNameAndParent(): void
    {
        $parent = new Category();
        $parent->setName('Parent Category');

        $child = new Category();
        $child->setName('Child Category');
        $child->setParent($parent);

        $this->assertEquals('Child Category', $child->getName());

        $this->assertEquals('Parent Category', $parent->getName());

        $this->assertSame($parent, $child->getParent());
    }

}
