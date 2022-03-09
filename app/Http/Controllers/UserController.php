<?php

namespace App\Http\Controllers;

use App\Events\AddUserOnCourseEvent;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function GetAllUsers(): \Illuminate\Http\JsonResponse
    {
        $result = $this->user->GetAllUsers();
        return response()->json($result,200);
    }

    public function CreateUser(): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(),[
            'email'=>'required|email|unique:users,email,'.$this->user,
            'password'=>'required',
            'phone'=>"required",
            'first_name'=>"required",
            'last_name'=>"required",
        ]);
        $newUser = request()->json()->all();
        $result = $this->user->CreateUser($newUser);
        if ($result){
            return response()->json(['status'=>'success','message'=>'User created successfully'],201);
        }else{
            return response()->json(['status'=>'error','error'=>'Error creating user'],500);
        }
    }

    public function UpdateUser($userId): \Illuminate\Http\JsonResponse
    {
        $newUser = request()->json()->all();
        $result = $this->user->UpdateUser($userId,$newUser);
        if ($result){
            return response()->json(['status'=>'success','message'=>'User updated successfully'],200);
        }else{
            return response()->json(['status'=>'error','error'=>'Error updating user'],500);
        }

    }

    public function DeleteUser($userId): \Illuminate\Http\JsonResponse
    {
        $result = $this->user->DeleteUser($userId);
        if ($result){
            return response()->json(['status'=>'success','message'=>'User deleted successfully'],204);
        }else{
            return response()->json(['status'=>'error','error'=>'Error deleting user'],500);
        }
    }

    public function LoginUser(){
        //validation
        $this->validate(request(),[
            'email'=>'required',
            'password'=>'required'
        ]);

        $userData = request()->json()->all();
        $result = $this->user->LoginUser($userData);
        if (!$result){
            return response()->json(['status'=>'error','error'=>'Invalid credential'],403);
        }else{
            return response()->json(['status'=>'success','message'=>'auth successful','token'=>$result],200);
        }
    }

    public function EnrollUserOnCourse(){
        //validation
        $this->validate(request(),[
            "course_id"=>'required'
        ]);
        try {
            $token = request()->bearerToken();
            $decoded = JWT::decode($token,new Key(env('JWT_SECRET'),'HS256'));
            $courseId = request()->json()->get('course_id');
            event(new AddUserOnCourseEvent($decoded->id,$courseId));
            $result = $this->user->EnrollUserOnCourse($decoded->id,$courseId);
            if ($result){
                return response()->json(['status'=>'success','message'=>'Successfully enroll on course'],200);
            }else{
                return response()->json(['status'=>'error','error'=>'Error enroll on course'],500);
            }
        }catch (Exception $exception){
            return response()->json(['status'=>'error','error'=>'user already on course'],500);
        }

    }
}
