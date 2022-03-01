<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function DeleteUsers($userId): \Illuminate\Http\JsonResponse
    {
        $result = $this->user->DeleteUser($userId);
        if ($result){
            return response()->json(['status'=>'success','message'=>'User deleted successfully'],204);
        }else{
            return response()->json(['status'=>'error','error'=>'Error deleting user'],500);
        }
    }
}
