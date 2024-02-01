<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function registrar(Request $request) {
        $this->validate($request, [
            "name"=>"required|max:255",
            "email"=>"required|email|max:255|unique:users",
            "password"=>"required|min:6|confirmed"
        ]);

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            "usuario"=>$user,
            "token"=>$token
        ],201);
    }
    public function login(LoginRequest $request) {
        $credencials = $request->only('email','password');

        try {
            if (!$token = JWTAuth::attempt($credencials)) {
                return response()->json([
                    "error"=>"invalid credentials"
                ],400);
            }
        } catch (JWTException  $e) {
            return response()->json([
                "error"=>"no create token"
            ],500);
        }
        return response()->json(compact('token'));
    }
}
