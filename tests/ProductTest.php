<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->app->instance('middleware.disable', true);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testGetAllProducts()
    {
        $prod = $this->generateProducts(3);

        $res = $this->json('GET', "/products")
            ->seeJson([
                'name' => $prod->get(0)->name,
                'name' => $prod->get(1)->name,
                'name' => $prod->get(2)->name,
            ]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testGetAProduct()
    {
        $prod = $this->generateProducts()->first();

        $this->json('GET', "/products/{$prod->id}")
            ->seeJson([
                'name' => $prod->name,
                'description' => $prod->description,
                'price' => $prod->price,
            ]);
    }

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

        $response = $this->json('POST', '/products', $params);
        $this->seeInDatabase('products', ['name' => $params['name']]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testUpdateAProduct()
    {
        $prod = $this->generateProducts()->first();
        $this->seeInDatabase('products', ['name' => $prod->name]);

        $params = [
            'name' => 'Google Pixel XL',
            'description' => 'The best phone on the market',
            'price' => 699.99,
        ];

        $response = $this->json('PUT', "/products/{$prod->id}", $params);
        $this->seeInDatabase('products', [
            'name' => $params['name'],
            'description' => $params['description'],
            'price' => $params['price'],
        ]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testDeleteAProduct()
    {
        $prod = $this->generateProducts()->first();
        $this->seeInDatabase('products', ['id' => $prod->id]);
        $this->json('DELETE', "/products/{$prod->id}");
        $this->notSeeInDatabase('products', ['id' => $prod->id]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testGetAUsersProducts()
    {
        $prod = factory(App\Product::class)->make();
        $user = $this->generateUsers()->first();

        $user->products()->save($prod);

        $this->json('GET', "/products/user/{$user->id}")
            ->seeJson([
                'user_id' => $user->id,
                'name' => $prod->name,
                'description' => $prod->description,
                'price' => $prod->price,
            ]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testAssociateAProductToAUser()
    {
        $user = $this->generateUsers()->first();
        $prod = $this->generateProducts()->first();

        $this->json('PUT', "/products/{$prod->id}/user/{$user->id}");
        $this->seeInDatabase('products', [
            'id' => $prod->id,
            'user_id' => $user->id,
        ]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testDissociateAProductForAUser()
    {
        $prod = factory(App\Product::class)->make();
        $user = $this->generateUsers()->first();

        $user->products()->save($prod);

        $this->json('PUT', "/products/{$prod->id}/user");
        $this->notSeeInDatabase('products', [
            'id' => $prod->id,
            'user_id' => $user->id,
        ]);
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function testUploadAnImageForAProduct()
    {
        $this->markTestSkipped();

        // TODO: create a mock image file

        $prod = $this->generateProducts()->first();
        $filePath = base_path().$product->id."-".$file->getClientOriginalName();

        $response = $this->call('PUT', "/products/{$prod->id}/image");
        $this->seeInDatabase('products', [
            'id' => $prod->id,
            'image' => $filePath,
        ]);
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

    /**
    * A basic test example.
    *
    * @return void
    */
    protected function generateUsers($num = 1)
    {
        return factory(App\User::class, $num)->create();
    }
}
