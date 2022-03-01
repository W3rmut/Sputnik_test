<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{

    private $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function GetAllCourses(){
        $result = $this->course->GetAllCourses();
        return response()->json($result);
    }

    public function CreateCourse(){
        $newCourse = request()->json()->all();
        $result = $this->course->CreateCourse($newCourse);
        if ($result){
            return response()->json(['status'=>'success','message'=>'Course created successfully'],201);
        }else{
            return response()->json(['status'=>'error','error'=>'Error creating user'],500);
        }

    }


}
