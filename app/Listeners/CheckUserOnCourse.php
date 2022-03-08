<?php

namespace App\Listeners;

use App\Events\AddUserOnCourseEvent;
use ErrorException;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CheckUserOnCourse
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
        $data=DB::table('course_users')->where('course_id',$event->courseId)->where('user_id',$event->userId)->first();
        if ($data != null) {
            throw new Exception('User already on course');
        }
    }
}


