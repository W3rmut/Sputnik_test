<?php

namespace App\Listeners;

use App\Events\AddUserOnCourseEvent;
use ErrorException;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CheckCountsStudents
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
     * @param \App\Events\AddUserOnCourseEvent $event
     * @return void
     * @throws Exception
     */
    public function handle(AddUserOnCourseEvent $event)
    {
        $userCapacity = DB::table('courses')->where('id',$event->courseId)->first();
        $userCount = count(DB::table('course_users')->where('course_id',$event->courseId)->get());
        if ($userCount >= $userCapacity->student_capacity){
            throw new Exception('No have free places on course');
        }
    }
}



