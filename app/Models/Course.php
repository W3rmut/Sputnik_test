<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable= ['id','title','student_capacity','start_date','end_date','has_certificate'];
    public $timestamps = false;

    public function GetAllCourses(){
        $data = $this->all();
        foreach($data as $course){
            $lessons = Course::find($course->id)->lessons;
            $course['lessons'] = $lessons;
        }
        return $data;
    }

    public function CreateCourse($course): bool
    {
        try{
            $this->create($course);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function GetLessons($courseId){
        return Course::find($courseId)->lessons;
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

}

