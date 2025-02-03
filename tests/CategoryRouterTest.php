<?php

namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryRouterTest extends WebTestCase
{
    public function testAddCategory(): void
    {
        $client = static::createClient();

        // Simulate adding a category via POST request
        $client->request('POST', '/category/add', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'name' => 'New Category',
            'parentId' => 1,
        ]));

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }
}
