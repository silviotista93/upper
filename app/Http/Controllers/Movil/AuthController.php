<?php

namespace App\Http\Controllers\Movil;

use App\Mail\NewClienteUpper;
use App\UserSocialAccount;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
            'email'   => 'required|string|email|unique:users',

        ]);
        $user = new User([
            'name'     => $request->name,
            'last_name'     => $request->last_name,
            'email'    => $request->email,
            'avatar' => '/movil/img/perfil.jpg',
            'slug' => Str::slug($request->name . mt_rand(1,10000), '-'),
            'password' => $pass,
            'phone_1' => $request->phone_1,

        ]);
        $user->save();
        $user->roles()->attach(['3']);

        \Mail::to($user->email)->send(new NewClienteUpper($user->email,$password));
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }

    public function updatePassword (Request $request){
        if ( $request->filled('password')) {
            $this->validate($request, [
                'password' => 'confirmed|min:8',
            ]);
            $password = $request->get('password');
            $newpassword = bcrypt($password);
            $user = User::where('id',$request->id)->update([
                'password' => $newpassword
            ]);
            return response()->json([
                'message' => 'Successfully password update!'], 201);
        } else {
            return response()->json([
                'message' => 'there are no changes'], 201);
        }

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
    {   $userLogin = User::where('id',$request->user()->id)->with('socialAcounts')->first();
        return response()->json(['user' => $userLogin]);
    }


    public function loginFacebook (Request $request)
    {
        $user = null; //Declaramos la variable user null para despues usarla y validar que los datos del usuarios son null
        $success = true; //$success es para al final del registro dar una alerta de que ha sido un exito
        $email = $request->email; //$email la declaramos para almacenar el email que nos trae facebook
        $check = User::whereEmail($email)->first();
        if ($check) {
            $user = $check;
        } else {

                $user = new User([
                    'name' => $request->name,
                    'email' => $email,
                    'slug' => Str::slug($request->name. mt_rand(1,10000), '-'),
                    'avatar' => $request->avatar,
                ]);
                $user->save();
                //a este usuario le asignamos los roles, Artista y Patrocinador
                $user->roles()->attach(['3']);
                //Almacenamos en la base de datos el proveedor de red social con el cual el usuario ha hecho login
                UserSocialAccount::create([
                    'user_id' => $user->id,
                    'provider' => 'Facebook',
                    'provider_uid' => $request->id,
                ]);

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
                'message' => 'Successfully created user!'
            ], 201);
        }
        if ($success === true) {

            $user = $check;
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
    }

}
