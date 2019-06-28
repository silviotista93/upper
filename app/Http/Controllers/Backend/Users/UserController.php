<?php

namespace App\Http\Controllers\Backend\Users;

use App\Mail\NewUserRegister;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index (){
        $users = User::with('roles')->whereHas('roles',function ($q){
            $q->where('roles_id','=',1);
        })->get();
        return view('backend.users.admin_users', compact('users'));
    }

    public function store (Request $request) {
        $this->validate($request,[
            'names' => 'required|string|max:255',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_1' => 'required',
            ]);
        $password = Str::random(8);
        $pass = bcrypt($password);

        $add_user = User::create([
           'names' => $request->get('names'),
           'last_name' => $request->get('last_name'),
           'email' => $request->get('email'),
           'phone_1' => $request->get('phone_1'),
           'avatar' => '/movil/img/perfil.jpg',
            'slug' => Str::slug(ucfirst($request->get('names')).'-'. mt_rand(1,10000), '-'),
            'password' => $pass
        ]);
        \Mail::to($add_user->email)->send(new NewUserRegister($add_user->email, $password));
        $add_user->roles()->attach(['1']);

        return back()->with('success','Usuario creado exitosamente');
    }
    public function update_state_users(Request $request, User $user, $state)
    {
        if ($state === "1") {
            $user->state = "1";
        } else if ($state == "2") {
            $user->state = "2";
        } else {
            return false;
        }
        return json_encode($user->update());
    }
}
