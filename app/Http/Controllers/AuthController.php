<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request) {

        $data = $request->validated();

        $user = User::firstWhere('email', $data['email']);

        
        if(!$user || !Hash::check($data['password'], $user->password)){
            throw ValidationException::withMessages([
                'email'=>'email esta invalido'
            ]);
        }
    

        return [
            'token'=> $user->createToken('auth_token')->plainTextToken,
            'user'=> $user
        ];
    }

    public function register(RegisterRequest $request){
            $data = $request->validated();

            $user= User::create([
                'name'=> $data['name'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password'])
            ]);

            return response()->json([
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);

    }
}
