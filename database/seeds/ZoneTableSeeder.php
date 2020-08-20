<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone')->insert([
            ['name' => '櫃檯A'],
            ['name' => '櫃檯B'],
            ['name' => '櫃檯C'],
            ['name' => '櫃檯D'],
            ['name' => '櫃檯E']
        ]);
    }
}
