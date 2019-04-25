<?php

namespace App\Http\Controllers\Movil;

use App\Mail\NewClienteUpper;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $password = trim(Str::random(8));
        $pass = bcrypt($password);
        $request->validate([
            'name'     => 'required|string',
            'last_name' => 'required|string',
            'email'    => 'required|string|email|unique:users',

        ]);
        $user = new User([
            'name'     => $request->name,
            'last_name'     => $request->last_name,
            'email'    => $request->email,
            'avatar' => '/movil/img/perfil.jpg',
            'slug' => Str::slug($request->name. mt_rand(1,10000), '-'),
            'password' => $pass,
            'phone_1' => $request->phone_1,

        ]);
        $user->save();
        $user->roles()->attach(['3']);

        \Mail::to($user->email)->send(new NewClienteUpper($user->email,$password));
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
