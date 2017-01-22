<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GoodsSkusTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(array(
            'id' => 1,
            'phone' => "13533876424",
            'email' => "admin@gmail.com",
            'name' => "admin",
            'password' => Hash::make('admin'),
            'nickname' => "admin",
            'sex' => 1,
        ));
    }

}

class GoodsSkusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('goods_skus')->insert(array(
            'id' => 1,
            'name' => "手机",
            'pid' => 0,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 2,
            'name' => "版本",
            'pid' => 1,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 3,
            'name' => "港版",
            'pid' => 2,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 4,
            'name' => "国行",
            'pid' => 2,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 5,
            'name' => "容量",
            'pid' => 1,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 6,
            'name' => "8g",
            'pid' => 5,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 7,
            'name' => "16g",
            'pid' => 5,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 8,
            'name' => "128g",
            'pid' => 5,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 9,
            'name' => "颜色",
            'pid' => 1,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 10,
            'name' => "金色",
            'pid' => 9,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 11,
            'name' => "黑色",
            'pid' => 9,
        ));
        DB::table('goods_skus')->insert(array(
            'id' => 12,
            'name' => "白色",
            'pid' => 9,
        ));

    }
}

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('images')->insert(array(
            'id' => 1,
            'name' => "14843760905082.jpg",
        ));
    }

}