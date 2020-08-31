<?php

use App\Client;
use App\Income;
use App\Price;
use App\Product;
use App\Seller;
use App\Voucher;
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
        factory(Price::class,100)->create();
        factory(Product::class,100)->create();
        factory(Client::class,100)->create();
        factory(Income::class,100)->create();
        factory(Seller::class,10)->create();
        factory(Voucher::class,100)->create();
    }
}
