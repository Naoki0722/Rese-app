<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'オーナー太郎',
            'email' => 'owner@example.com',
            'password' => bcrypt('owner1234'),
            'role' => 'owner'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'お客花子',
            'email' => 'customer@example.com',
            'password' => bcrypt('customer1234'),
            'role' => 'customer'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '管理者持田',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin1234'),
            'role' => 'admin'
        ];
        DB::table('users')->insert($param);
    }
}
