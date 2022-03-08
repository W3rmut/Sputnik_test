<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //lessons for course English
        DB::table('lessons')->insert([
            "course_id"=>1,
            "theme"=>"Past Simple",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>1,
            "theme"=>"Present Simple",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>1,
            "theme"=>"Future Simple",
        ]);
        //lessons for course PHP
        DB::table('lessons')->insert([
            "course_id"=>2,
            "theme"=>"Why you shouldn't use php",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>2,
            "theme"=>"Why you shouldn't use laravel",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>2,
            "theme"=>"Why you still here ?",
        ]);

        //lessons for course PHP
        DB::table('lessons')->insert([
            "course_id"=>3,
            "theme"=>"Layouts",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>3,
            "theme"=>"Filters",
        ]);
        DB::table('lessons')->insert([
            "course_id"=>3,
            "theme"=>"Colors",
        ]);
    }
}


