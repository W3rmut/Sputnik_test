<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            "title"=>"Test English Course",
            "student_capacity"=>5,
            "start_date"=>"2022-05-01",
            "end_date"=>"2022-05-06",
            "has_certificate"=>false,
        ]);

        DB::table('courses')->insert([
            "title"=>"Test PHP Course",
            "student_capacity"=>2,
            "start_date"=>"2022-05-02",
            "end_date"=>"2022-05-07",
            "has_certificate"=>true,
        ]);

        DB::table('courses')->insert([
            "title"=>"Test Photoshop Course",
            "student_capacity"=>1,
            "start_date"=>"2022-05-03",
            "end_date"=>"2022-05-10",
            "has_certificate"=>false,
        ]);


    }
}

