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
        ], [
            'name' => '蓮子',
            'subname' => '蓮肉 蓮米 藕實 水芝丹 蓮實 澤芝 蓮蓬子 薂',
            'category_id' => 1
        ], [
            'name' => '山藥',
            'subname' => '懷山藥 淮山藥 土薯 山薯 山芋 玉延 薯蕷',
            'category_id' => 1
        ], [
            'name' => '茯苓',
            'subname' => '茯菟 茯靈 茯蕶 茯兔 伏苓 伏菟 松腴 松薯 松苓 雲苓',
            'category_id' => 1
        ], [
            'name' => '芡實',
            'subname' => '艻子 鴻頭 水流黃 水雞頭 肇實 刺蓮藕 刀芡實 雞頭果 蘇黃 黃實 雞癕 蔿子',
            'category_id' => 1
        ]]);
    }
}
