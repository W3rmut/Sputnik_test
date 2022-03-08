<?php

namespace App\Models;

use App\Events\AddUserOnCourseEvent;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    protected $fillable= ['id','course_id','theme'];
    public $timestamps = false;

    public function EndLesson($userId,$lessonId){
        DB::table('lessons_users')->where('lesson_id',$lessonId)->where('user_id',$userId)->update([
            'is_passed'=>true,
        ]);


    }
}

