<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price')->insert([[
            'option_id' => 1,
            'unit_id' => 4,
            'value' => 30
        ], [
            'option_id' => 1,
            'unit_id' => 5,
            'value' => 420
        ], [
            'option_id' => 2,
            'unit_id' => 4,
            'value' => 10
        ], [
            'option_id' => 2,
            'unit_id' => 5,
            'value' => 100
        ], [
            'option_id' => 3,
            'unit_id' => 4,
            'value' => 300
        ], [
            'option_id' => 3,
            'unit_id' => 5,
            'value' => 4200
        ], [
            'option_id' => 4,
            'unit_id' => 4,
            'value' => 250
        ], [
            'option_id' => 4,
            'unit_id' => 5,
            'value' => 3000
        ], [
            'option_id' => 5,
            'unit_id' => 1,
            'value' => 70
        ], [
            'option_id' => 6,
            'unit_id' => 1,
            'value' => 100
        ], [
            'option_id' => 7,
            'unit_id' => 1,
            'value' => 50
        ], [
            'option_id' => 8,
            'unit_id' => 1,
            'value' => 100
        ]]);

        DB::table('option')->where('id', 1)->update(['default_price_id' => 1]);
        DB::table('option')->where('id', 2)->update(['default_price_id' => 3]);
        DB::table('option')->where('id', 3)->update(['default_price_id' => 5]);
        DB::table('option')->where('id', 4)->update(['default_price_id' => 7]);
        DB::table('option')->where('id', 5)->update(['default_price_id' => 9]);
        DB::table('option')->where('id', 6)->update(['default_price_id' => 10]);
        DB::table('option')->where('id', 7)->update(['default_price_id' => 11]);
        DB::table('option')->where('id', 8)->update(['default_price_id' => 12]);
    }
}
