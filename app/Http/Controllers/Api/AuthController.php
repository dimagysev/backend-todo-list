<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisrerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
               'error' => 'Invalid email/password'
            ], 500);
        }
        return response()->json(['token' => $token]);
    }

    public function register(AuthRegisrerRequest $request)
    {
        $credentials = $request->validated();
        $user = User::query()->create([
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'name' => $credentials['name']
        ]);
        if (!$user) {
            return response()->json(['error' => 'Invalid email/password'], 500);
        }
        $token = auth()->attempt([
            'email' => $credentials['email'],
            'password' =>$credentials['password']
        ]);
        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['success' => 'Logout successfully']);
    }
}
