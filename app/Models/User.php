<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $fillable= ['id','email','password','phone','first_name','last_name','is_admin'];
    public $timestamps = false;

    public function GetAllUsers(){
        return $this->all();
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


}
