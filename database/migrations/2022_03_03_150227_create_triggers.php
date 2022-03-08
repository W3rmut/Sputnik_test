<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                   CREATE OR REPLACE FUNCTION add_user_lesson()
              RETURNS trigger AS
            $$
                   declare lessons_id CURSOR FOR select id from lessons where new.course_id = lessons.course_id;

            BEGIN

                FOR test IN lessons_id LOOP
                     INSERT INTO lessons_users(user_id, lesson_id, is_passed)
                     VALUES(NEW.user_id, test.id, false);
                END LOOP;
                RETURN NEW;
            END
            $$
            LANGUAGE \'plpgsql\';

            CREATE TRIGGER test_trigger
              AFTER INSERT
              ON course_users
              FOR EACH ROW
              EXECUTE PROCEDURE add_user_lesson();

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_User_Default_Member_Role`');
    }
}
