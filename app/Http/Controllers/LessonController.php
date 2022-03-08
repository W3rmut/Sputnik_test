<?php

namespace App\Http\Controllers;

use App\Events\AddUserOnCourseEvent;
use App\Events\ChangeLessonStatusEvent;
use App\Models\Lesson;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LessonController extends Controller
{
    private $lesson;

    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function EndLesson($lessonId){
        $decoded = JWT::decode(request()->bearerToken(),new Key(env('JWT_SECRET'),'HS256'));
        $userId= $decoded->id;
        $this->lesson->EndLesson($userId,$lessonId);
        event(new ChangeLessonStatusEvent($userId,$lessonId));
        return response()->json(['status'=>'success','message'=>'lesson status successfully updated']);
    }
}

