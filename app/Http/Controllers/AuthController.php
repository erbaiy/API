<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return response()->json($user, 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        $user = Auth::user();
        //create a token for the user
        $token = $user->createToken('token')->plainTextToken;
        // restar the token inide the cookies
        $cookie = cookie('jwt', $token, 24 * 60);


        return response([

            "message" => "Bienvenue"
        ])->withCookie($cookie);
    }
    public function user()
    {
        $user = Auth::user();
        return response()->json($user);
    }
}
