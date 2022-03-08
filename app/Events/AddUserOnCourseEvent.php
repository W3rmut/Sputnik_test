<?php

namespace App\Events;

class AddUserOnCourseEvent extends Event
{
    public $userId;
    public $courseId;

    public function __construct($userId,$courseId)
    {
        $this->userId = $userId;
        $this->courseId = $courseId;
    }
}


