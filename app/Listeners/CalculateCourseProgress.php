<?php

namespace App\Listeners;

use App\Events\AddUserOnCourseEvent;
use App\Events\ChangeLessonStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CalculateCourseProgress
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ChangeLessonStatusEvent  $event
     * @return void
     */
    public function handle(ChangeLessonStatusEvent $event)
    {
        $courseId =DB::table('lessons')->where('id',$event->lessonId)->first();
        $courseId = $courseId->course_id;
        $lessons = DB::table('lessons')->where('course_id',$courseId)->get();
        $countComplete = 0;
        foreach ($lessons as $lesson){
            $lesson_user = DB::table('lessons_users')->where('lesson_id',$lesson->id)->first();
            if ($lesson_user->is_passed){
                $countComplete ++;
            }
        }
        $percent = $countComplete / count($lessons) * 100;
        DB::table('course_users')->where('course_id',$courseId)->update([
            'percentage_passing'=>(int) $percent,
        ]);
        //dd($courseId,$lessons);

    }
}

