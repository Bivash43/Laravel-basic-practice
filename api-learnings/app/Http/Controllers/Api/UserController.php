<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(Request $request){

        $validateData = $request->validate([
            'name' => 'required',
            'email' => ['required' , 'email'],
            'password' => ['required' , 'min:8' , 'confirmed']
        ]);

        $user = User::create($validateData);
        $token = $user->createToken("auth_token")->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Registration Successfull',
            'statut' => 1
        ]);

    }

    public function login(Request $request){

        $validateData = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where(['email'=>$validateData['email']])->first();

        if ($user && Hash::check($validateData['password'], $user->password)) {
            $token = $user->createToken("auth_token")->accessToken;
            return response()->json(
            [
                'token' =>$token,
                'user' => $user,
                'message' => 'Login Successfull',
                'statut' => 1
            ]
        );
        } else {
            return response()->json(
            [
                'message' => 'Login Error',
            ]
            );
        }    
    }

    public function getUser($id){
        $user = User::where(['id'=>$id])->first();

        if(is_null($user)){
            return response()->json([
                'message' => 'Not Authenticated',
                'status' => 0
            ]);
        }else{
            return response()->json([
                'user' =>$user,
                'message'=> 'Successful',
                'statut' => 1
            ]);
            }
        }

}
