<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => '藥材',
        ]);
        DB::table('category')->insert([
            'name' => '藥粉',
        ]);
        DB::table('category')->insert([
            'name' => '藥丸',
        ]);
        DB::table('category')->insert([
            'name' => '藥水',
        ]);
        DB::table('category')->insert([
            'name' => '藥帖',
        ]);
        DB::table('category')->insert([
            'name' => '其他',
        ]);
    }
}
