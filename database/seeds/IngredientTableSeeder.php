<?php

use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient')->insert([[
            'option_id' => 5,
            'description' => '小份量',
        ], [
            'option_id' => 6,
            'description' => '大份量',
        ]]);

        DB::table('ingredient_option')->insert([[
            'ingredient_id' => 1,
            'option_id' => 9,
            'unit_id' => 3,
            'quantity' => 8,
        ], [
            'ingredient_id' => 1,
            'option_id' => 10,
            'unit_id' => 3,
            'quantity' => 8,
        ], [
            'ingredient_id' => 1,
            'option_id' => 11,
            'unit_id' => 3,
            'quantity' => 8,
        ], [
            'ingredient_id' => 1,
            'option_id' => 12,
            'unit_id' => 3,
            'quantity' => 8,
        ], [
            'ingredient_id' => 2,
            'option_id' => 9,
            'unit_id' => 3,
            'quantity' => 12,
        ], [
            'ingredient_id' => 2,
            'option_id' => 10,
            'unit_id' => 3,
            'quantity' => 12,
        ], [
            'ingredient_id' => 2,
            'option_id' => 11,
            'unit_id' => 3,
            'quantity' => 10,
        ], [
            'ingredient_id' => 2,
            'option_id' => 12,
            'unit_id' => 3,
            'quantity' => 10,
        ]]);
    }
}
