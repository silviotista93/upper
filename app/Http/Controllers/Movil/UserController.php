<?php

namespace App\Http\Controllers\Movil;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
  
    #region ACTUALIZAR USUARIO
    public function update(Request $request)
    {
        if($request){        
        $this->validate($request, [
            'names' => 'required',
            'last_name' => 'required',
            'phone_1' => 'required',
        ]);
        $updateProfile = User::where('id',$request->id)->update([
            'names' => ucfirst($request->names),
            'last_name' => ucfirst($request->last_name),
            'slug' => Str::slug(ucfirst($request->names) . mt_rand(1,10000), '-'),
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
        ]);
        $userToken = User::where('id', $request->id)->first();
    
        $tokenResult =$userToken->createToken('Personal Access Token');
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
            'message' => '¡Actualizacion exitosa!'
            ],201);
        }
        else {
            return response()->json([
                'error' => 'Usuario no actualizado'], 201);
        }
    }
    #endregion

    #region ACTUALIZAR PASSWORD
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
            $userToken = User::where('id', $request->id)->first();
            $tokenResult = $userToken->createToken('Personal Access Token');
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
                'message' => 'Contraseña actualizada'
                ],201);
            
        } else {
            return response()->json([
                'error' => 'Contraseña no actualizada'], 201);
        }
    }
    #endregion
    
    #region ACTUALIZAR AVATAR
    public function updateAvatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::where('id',$request->user()->id)->first();
        
        $file = new Filesystem;
        $file->cleanDirectory('storage/avatars/'.$user->id);
        
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar;
        $path = $request->file('avatar')->store('avatars/'.$user->id);  

        $user->avatar = '/storage/'.$path;
        $user->save();
        
        return $user->avatar;
    }
    #endregion

    public function destroy($id)
    {
        //
    }
}
