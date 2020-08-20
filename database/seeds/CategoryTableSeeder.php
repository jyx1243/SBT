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
            ['name' => '藥材'],
            ['name' => '藥粉'],
            ['name' => '藥丸'],
            ['name' => '藥水'],
            ['name' => '藥帖'],
            ['name' => '其他']
        ]);
    }
}
