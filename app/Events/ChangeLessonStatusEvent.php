<?php

namespace App\Events;

class ChangeLessonStatusEvent extends Event
{
    public $userId;
    public $lessonId;

    public function __construct($userId,$lessonId)
    {
        $this->userId = $userId;
        $this->lessonId = $lessonId;
    }
}

