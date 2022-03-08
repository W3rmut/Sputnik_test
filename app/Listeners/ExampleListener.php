<?php

namespace App\Listeners;

use App\Events\AddUserOnCourseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExampleListener
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
     * @param  \App\Events\AddUserOnCourseEvent  $event
     * @return void
     */
    public function handle(AddUserOnCourseEvent $event)
    {
        //
    }
}
