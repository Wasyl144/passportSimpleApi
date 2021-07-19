<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::find(auth()->user()->id);
            return response()->json([
                "status" => "Jestes zalogowany",
                "auth_token" => $user->createToken('Auth token')->accessToken
            ]);
        }

        return response()->json([
            "status" => "Problem z zalogowaniem sie"
        ], 404);
    }
}
