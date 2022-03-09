<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([
            "first_name"=>"admin",
            "last_name"=>"test",
            "phone"=>"88005553535",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
            'is_admin'=>true,
        ]);
        DB::table('users')->updateOrInsert([
            "first_name"=>"John",
            "last_name"=>"Doe",
            "phone"=>"88005553532",
            'email' => "user1@gmail.com",
            'password' => Hash::make('user1'),
            'is_admin'=>false,
        ]);
        DB::table('users')->updateOrInsert([
            "first_name"=>"John",
            "last_name"=>"Doe",
            "phone"=>"88005553531",
            'email' => "user2@gmail.com",
            'password' => Hash::make('user2'),
            'is_admin'=>false,
        ]);
    }
}
