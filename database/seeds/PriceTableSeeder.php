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
            'unit_id' => 3,
            'value' => 30
        ], [
            'option_id' => 1,
            'unit_id' => 4,
            'value' => 420
        ], [
            'option_id' => 2,
            'unit_id' => 3,
            'value' => 10
        ], [
            'option_id' => 2,
            'unit_id' => 4,
            'value' => 100
        ], [
            'option_id' => 3,
            'unit_id' => 3,
            'value' => 300
        ], [
            'option_id' => 3,
            'unit_id' => 4,
            'value' => 4200
        ], [
            'option_id' => 4,
            'unit_id' => 3,
            'value' => 250
        ], [
            'option_id' => 4,
            'unit_id' => 4,
            'value' => 3000
        ]]);
    }
}
