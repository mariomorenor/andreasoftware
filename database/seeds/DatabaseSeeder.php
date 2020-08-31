<?php

use App\Client;
use App\Income;
use App\Price;
use App\Product;
use App\Seller;
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
        factory(Income::class,10000)->create();
        factory(Seller::class,500)->create();
    }
}
