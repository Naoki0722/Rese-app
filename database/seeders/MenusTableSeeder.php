<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //寿司屋
        $param = [
            'menu_name' => '【梅】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 1,
            'price' => 12000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【竹】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 1,
            'price' => 15000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【梅】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 10,
            'price' => 12000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【梅】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 17,
            'price' => 12000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【竹】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 17,
            'price' => 15000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【竹】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 10,
            'price' => 15000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【梅】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 20,
            'price' => 12000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【竹】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 20,
            'price' => 15000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【梅】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 14,
            'price' => 12000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '【竹】職人のこだわりコース・2時間飲み放題付',
            'shop_id' => 14,
            'price' => 15000,
        ];
        DB::table('menus')->insert($param);

        //焼肉屋
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 2,
            'price' => 6000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 2,
            'price' => 8000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 6,
            'price' => 6000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 6,
            'price' => 8000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 12,
            'price' => 6000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 12,
            'price' => 8000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 11,
            'price' => 6000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 11,
            'price' => 8000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 18,
            'price' => 6000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 18,
            'price' => 8000,
        ];
        DB::table('menus')->insert($param);
        
        //居酒屋
        $param = [
            'menu_name' => '宴会コース【全6品】・2時間飲み放題付',
            'shop_id' => 3,
            'price' => 3000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全8品】・2時間飲み放題付',
            'shop_id' => 3,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全6品】・2時間飲み放題付',
            'shop_id' => 9,
            'price' => 3000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全8品】・2時間飲み放題付',
            'shop_id' => 9,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全6品】・2時間飲み放題付',
            'shop_id' => 13,
            'price' => 3000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全8品】・2時間飲み放題付',
            'shop_id' => 13,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全6品】・2時間飲み放題付',
            'shop_id' => 16,
            'price' => 3000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '宴会コース【全8品】・2時間飲み放題付',
            'shop_id' => 16,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);

        //イタリアン
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 4,
            'price' => 4000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 4,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 7,
            'price' => 4000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 7,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スタンダードコース・2時間飲み放題付',
            'shop_id' => 19,
            'price' => 4000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => 'スペシャルコース・2時間飲み放題付',
            'shop_id' => 19,
            'price' => 5000,
        ];
        DB::table('menus')->insert($param);

        //ラーメン
        $param = [
            'menu_name' => '味噌ラーメン',
            'shop_id' => 5,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '醤油ラーメン',
            'shop_id' => 5,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '味噌ラーメン',
            'shop_id' => 8,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '醤油ラーメン',
            'shop_id' => 8,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);

        $param = [
            'menu_name' => '味噌ラーメン',
            'shop_id' => 15,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);
        $param = [
            'menu_name' => '醤油ラーメン',
            'shop_id' => 15,
            'price' => 1000,
        ];
        DB::table('menus')->insert($param);

    }
}
