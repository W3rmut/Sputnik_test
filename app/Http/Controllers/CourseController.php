<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

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

    public function CreateCourse(Request $request){
        //validation
        $this->validate(request(),[
            "title"=>"required",
            "student_capacity"=>"required",
            "start_date"=>"required|date_format:Y-m-d",
            "end_date"=>"required|date_format:Y-m-d",
            "has_certificate"=>"required"
        ]);


        $newCourse = request()->json()->all();
        $result = $this->course->CreateCourse($newCourse);
        if ($result){
            return response()->json(['status'=>'success','message'=>'Course created successfully'],201);
        }else{
            return response()->json(['status'=>'error','error'=>'Error creating user'],500);
        }

    }

    public function GetLessons(){

        $courseId = request()->input('course_id');
        $lessons = $this->course->GetLessons($courseId);
        return response()->json($lessons);
    }


}
