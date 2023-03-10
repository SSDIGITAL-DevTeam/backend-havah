<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\PhoneNumberConverter;

class AuthController extends ApiController
{
    use PhoneNumberConverter;

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|min:3',
                'birth' => 'required',
                'phone_number' => 'required|unique:users,phone_number',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:6',
            ]);
            
            if($validator->fails()){
                return response()->json([
                    'message' => $validator->errors()
                ]);
            }

            $phone_number = $this->format($request->phone_number);

            $phone_check = Validator::make(['phone_number' => $phone_number], [
                'phonenumber' => 'unique:users'
            ]);

            if ($phone_check->fails()) {
                return $this->respondInvalid($phone_check->errors()->first());
            }
    
            $user = User::create([
                'name' => trim($request->name),
                'birth' => $request->birth,
                'phone_number' => $phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Anda berhasil terdaftar',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data_user' => $user,
            ]);

        } catch (\Throwable $th) {
            return $this->respondInternalError(
                $th->getMessage()
            );
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password'    => 'required|min:6',
        ]);

        $phonenumber = $this->format($request->phone_number);

        $attempt = auth()->attempt([
            'phone_number' => $phonenumber,
            'password'    => $request->password
        ]);

        if ($attempt) {

            $user = User::where('phone_number', $phonenumber)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => "Login Success",
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data_user' => $user
            ]);

        } else {

            $phone_check = User::where('phonenumber', $phonenumber)->first();
            $pass_check = User::where('password', $request->password)->first();

            if ($phone_check == null && $pass_check == null) {
                return $this->respondUnauthorized('Nomor Whatsapp tidak Terdaftar dan Password Salah');
            } else if ($pass_check == null) {
                return $this->respondUnauthorized('Password Salah');
            } else {
                return $this->respondUnauthorized('Nomor Whatsapp tidak Terdaftar');
            }
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
    
}
