<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginUserRequest $request): Response
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            return Response([
                'token' => $user->createToken($user->email)->plainTextToken,
                'data' => $user
            ], 200);
        }
        return Response(['message' => 'email or password wrong'], 401);
    }

    public function register(RegisterUserRequest $request): Response
    {
        $userRegister = User::create($request->all());
        return Response([
            'message' => "Success",
            'data' => $userRegister
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return Response(['data' => 'User Logout successfully.'], 200);
    }

}
