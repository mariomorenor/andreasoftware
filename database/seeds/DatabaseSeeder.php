<?php

use App\Client;
use App\Income;
use App\Price;
use App\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        factory(Price::class,500)->create();
        factory(Product::class,500)->create();
        factory(Client::class,100)->create();
<<<<<<< HEAD
        factory(Income::class,100)->create();
=======
        factory(Income::class,10000)->create();
>>>>>>> 6edfb83834cd26c44f0d235ac5f869e6421ab2b0
    }
}
