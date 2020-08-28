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
        DB::table('location')->insert([[
            'option_id' => 1,
            'zone_id' => 4,
            'layer' => 3,
            'col' => 4,
            'row' => 1
        ], [
            'option_id' => 2,
            'zone_id' => 4,
            'layer' => 1,
            'col' => null,
            'row' => null
        ], [
            'option_id' => 3,
            'zone_id' => 3,
            'layer' => 3,
            'col' => null,
            'row' => null
        ], [
            'option_id' => 4,
            'zone_id' => 3,
            'layer' => 3,
            'col' => null,
            'row' => null
        ], [
            'option_id' => 1,
            'zone_id' => 5,
            'layer' => 3,
            'col' => null,
            'row' => null
        ]]);

        DB::table('option')->where('id', 1)->update(['default_location_id' => 1]);
        DB::table('option')->where('id', 2)->update(['default_location_id' => 2]);
        DB::table('option')->where('id', 3)->update(['default_location_id' => 3]);
        DB::table('option')->where('id', 4)->update(['default_location_id' => 4]);
    }
}
