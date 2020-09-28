<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('option')->insert([[
            'product_id' => 1,
            'name' => null,
            'image' => '11.jpg'
        ], [
            'product_id' => 2,
            'name' => null,
            'image' => '21.jpg'
        ], [
            'product_id' => 3,
            'name' => '高麗蔘',
            'image' => '31.jpg'
        ], [
            'product_id' => 3,
            'name' => '石柱參',
            'image' => '32.jpg'
        ], [
            'product_id' => 4,
            'name' => '中',
            'image' => 'default.png'
        ], [
            'product_id' => 4,
            'name' => '大',
            'image' => 'default.png'
        ], [
            'product_id' => 5,
            'name' => '四物',
            'image' => 'default.png'
        ], [
            'product_id' => 5,
            'name' => '十全',
            'image' => 'default.png'
        ]]);
    }
}
