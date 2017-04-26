<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(\App\User::class, 3)->create();
    	factory(\App\Category::class, 5)->create();
    	factory(\App\Transaction::class, 50)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
