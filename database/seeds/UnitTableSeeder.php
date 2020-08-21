<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit')->insert([[
            'name' => '分',
            'standard' => 1,
            'multiple' => 1
        ], [
            'name' => '錢',
            'standard' => 1,
            'multiple' => 10
        ], [
            'name' => '兩',
            'standard' => 1,
            'multiple' => 100
        ], [
            'name' => '斤',
            'standard' => 1,
            'multiple' => 1600
        ], [
            'name' => '公克',
            'standard' => 2,
            'multiple' => 1
        ], [
            'name' => '公斤',
            'standard' => 2,
            'multiple' => 1000
        ]]);
    }
}
