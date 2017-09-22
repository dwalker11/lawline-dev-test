<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testCreateAProduct()
    {
        $params = [
            'name' => 'iPhoneX',
            'description' => 'The biggest hoax from Apple',
            'price' => 999.99,
        ];

        $response = $this->call('POST', '/products', $params);
        $this->seeInDatabase('products', ['name' => $params['name']]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testDeleteAProduct()
    {
        $this->markTestSkipped();
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testUpdateAProduct()
    {
        $this->markTestSkipped();
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testGetAProduct()
    {
        $this->markTestSkipped();
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testGetAllProducts()
    {
        $this->markTestSkipped();
    }
}
