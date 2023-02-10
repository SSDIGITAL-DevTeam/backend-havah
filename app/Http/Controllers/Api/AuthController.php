<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'birth' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:6',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = new user;
        $user->name = trim($request->name);
        $user->birth = $request->birth;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Anda berhasil terdaftar',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('phone_number','password'))){
            return response()->json([
                'status' => false,
                'message' => 'Phone number or password is wrong',
            ],401);
        }

        $user = User::where('phone_number', $request->phone_number)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => "Login Success",
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data_user' => $user
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
    
}
