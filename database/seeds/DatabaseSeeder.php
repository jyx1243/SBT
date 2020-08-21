<?php

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
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(OptionTableSeeder::class);
        $this->call(ZoneTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(SaleTableSeeder::class);
    }
}
