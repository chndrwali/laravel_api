<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
       $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
       ]);

       $user = User::create($fields);
       
       $token = $user->createToken($request->email);

       return [
        'user' => $user,
        'token' => $token->plainTextToken
       ];
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
       ]);

       $user = User::where('email', $request->email)->first(); 
       if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Email atau password anda salah'
            ];
       }

       $token = $user->createToken($user->email);

       return [
        'user' => $user,
        'token' => $token->plainTextToken
       ];

    }
    public function logout(Request $request) 
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Anda telah logout'
        ];
    }
}
