<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable= ['id','title','student_capacity','start_date','end_date','has_certificate'];
    public $timestamps = false;

    public function GetAllCourses(){
        return $this->all();
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


}

