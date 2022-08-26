<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = $request->validate([
            'username' => 'required',
            'name' => 'required|max:255',
            'password' => 'required'
        ]);

        $validator['password'] = bcrypt($request->password);

        $user = User::create($validator);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }

    public function login(Request $request) {
        $loginData = $request->validate([
           'username' => 'required',
           'password' => 'required',
        ]);

        if (!auth()->attempt($loginData)) {
            return response([
                'message' => 'Credenciales inválidas'
            ], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user' => auth()->user(),
            'token' => $accessToken
        ], 200);
    }
}
