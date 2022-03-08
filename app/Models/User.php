<?php

namespace App\Models;

use Exception;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $fillable= ['id','email','password','phone','first_name','last_name','is_admin'];
    protected $hidden=['password'];
    public $timestamps = false;

    public function GetAllUsers(){
        $data =  $this->all();
        foreach ($data as $user){
            $courses = DB::table('course_users')->where('user_id',$user->id)->orderByDesc('percentage_passing')->get();
            $user['courses'] = $courses;
        }
        return $data;
    }

    public function UpdateUser($userId, $updatedUser){
        try{
            $user = $this->find($userId);
            $user->update($updatedUser);
            return true;
        }catch (Exception $e){
            return false;
        }

    }

    public function DeleteUser($userId){

        try {
            $user = $this->find($userId);
            $user->delete();
            return true;
        }catch (Exception $exception){
            return false;
        }

    }

    public function CreateUser(array $newUser): bool
    {
        try{
            $newUser['password'] = Hash::make($newUser['password']);
            $this->create($newUser);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function LoginUser(array $userData)
    {
        try {
            $user =  $this->where('email',$userData['email'])->first();
            if(Hash::check($userData['password'],$user->password)){
                return $this->CreateToken($user);
            }else{
                return false;
            }
        }catch (Exception $exception){
            return false;
        }

    }

    public function CreateToken(User $user){

        $claims= [
            "id" => $user->id,
            "is_admin" => $user->is_admin,
            "iat" => 1356999524,
            "nbf" => 1357000000
        ];
        $token = JWT::encode($claims,env('JWT_SECRET'),'HS256');
        return $token;
    }

    public function EnrollUserOnCourse($userId,$courseId){
        try {
            DB::insert('insert into course_users (user_id, course_id,percentage_passing) values (?, ?,?)', [$userId, $courseId, 0]);
            return true;
        }catch (Exception $exception){
            return false;
        }

    }
}
