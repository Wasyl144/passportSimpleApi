<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;


class RegisterController extends Controller
{
    public function store(StoreUserRequest $request) {
        $credentials = $request->only(["email","name","password"]);
        $credentials['password'] = bcrypt($credentials['password']);
        User::create($credentials);
        return response()->json([
            "status" => "ok"
        ]);
    }
}
