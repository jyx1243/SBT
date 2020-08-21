<?php

use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale')->insert([[
            'price_id' => 5,
            'quantity' => 4,
            'value' => 1000
        ], [
            'price_id' => 7,
            'quantity' => 5,
            'value' => 1000
        ]]);
    }
}
