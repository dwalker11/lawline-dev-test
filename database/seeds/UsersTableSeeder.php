<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date("Y-m-d H:i:s");
        $password = app('hash')->make('password');

        DB::table('users')->insert(
            ['first_name' => 'Jon', 'last_name' => 'Snow', 'email' => 'jon@thewall.com', 'password' => $password, 'created_at' => $date, 'updated_at' => $date]
        );

        DB::table('users')->insert([
            ['first_name' => 'Robb', 'last_name' => 'Stark', 'email' => 'robb@winterfell.com', 'created_at' => $date, 'updated_at' => $date],
            ['first_name' => 'Jerry', 'last_name' => 'Smith', 'email' => 'jerry@example.com', 'created_at' => $date, 'updated_at' => $date],
            ['first_name' => 'Michael', 'last_name' => 'Jackson', 'email' => 'jackson@moonwalker.net', 'created_at' => $date, 'updated_at' => $date],
            ['first_name' => 'Michael', 'last_name' => 'Jordan', 'email' => 'jordan@jumpman.com', 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
