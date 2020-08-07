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
        DB::table('option')->insert([
            'product_id' => 1,
            'image' => '11',
        ]);
        DB::table('option')->insert([
            'product_id' => 2,
            'image' => '21',
        ]);
        DB::table('option')->insert([
            'product_id' => 3,
            'name' => '高麗蔘',
            'image' => '31',
        ]);
        DB::table('option')->insert([
            'product_id' => 3,
            'name' => '石柱參',
            'image' => '32',
        ]);
    }
}
