<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([[
            'name' => '黃耆',
            'subname' => '北耆 黃芪 木耆 綿黃芪',
            'category_id' => 1
        ], [
            'name' => '紅棗',
            'subname' => '大棗 乾棗 美棗 良棗',
            'category_id' => 1
        ], [
            'name' => '人參',
            'subname' => '人蔘 高麗蔘 吉林參 石柱參 紅參 黃參 血蔘 金井玉闌',
            'category_id' => 1
        ], [
            'name' => '四神湯',
            'subname' => '四臣湯',
            'category_id' => 5
        ], [
            'name' => '十全大補湯',
            'subname' => '十全飲 十補湯 藥膳湯',
            'category_id' => 5
        ]]);
    }
}
