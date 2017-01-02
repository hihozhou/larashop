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
