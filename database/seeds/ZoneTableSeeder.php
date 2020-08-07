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
            'name' => '櫃檯A',
        ]);
        DB::table('zone')->insert([
            'name' => '櫃檯B',
        ]);
        DB::table('zone')->insert([
            'name' => '櫃檯C',
        ]);
        DB::table('zone')->insert([
            'name' => '櫃檯D',
        ]);
        DB::table('zone')->insert([
            'name' => '櫃檯E',
        ]);
    }
}
