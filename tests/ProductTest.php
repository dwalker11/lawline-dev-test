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
        $prod = $this->generateProducts()->first();
        $this->seeInDatabase('products', ['name' => $prod->name]);

        $response = $this->call('DELETE', "/products/{$prod->id}");
        $this->notSeeInDatabase('products', ['name' => $prod->name]);
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

    /**
    * A basic test example.
    *
    * @return void
    */
    protected function generateProducts($num = 1)
    {
        return factory(App\Product::class, $num)->create();
    }
}
