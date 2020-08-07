<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert([
            'option_id' => 1,
            'zone_id' => 4,
            'layer' => 3,
            'col' => 4,
            'row' => 1,
        ]);
        DB::table('location')->insert([
            'option_id' => 2,
            'zone_id' => 4,
            'layer' => 1,
        ]);
        DB::table('location')->insert([
            'option_id' => 3,
            'zone_id' => 3,
            'layer' => 3,
        ]);
        DB::table('location')->insert([
            'option_id' => 4,
            'zone_id' => 3,
            'layer' => 3,
        ]);
    }
}
