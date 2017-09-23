<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $products = ['iPhoneX', 'Toyota Prius', 'MacBook Pro', 'iPad Pro', 'Xbox X'];

    return [
        'name' => $products[array_rand($products)],
        'description' => $faker->text,
        'price' => $faker->randomFloat(2, 0, 999.99),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});
