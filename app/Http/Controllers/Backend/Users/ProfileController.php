<?php

namespace App\Http\Controllers\Backend\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(User $user){
        return view('backend.users.profile_users', compact('user'));
    }

    public function update_profile_users (Request $request, User $user){

        $this->validate($request, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|string|email|max:255',
            'telefono' => 'required',

        ]);

        $user->update([
            'names' => $request->get('nombres'),
            'last_name' => $request->get('apellidos'),
            'email' => $request->get('email'),
            'phone_1' => $request->get('telefono'),
        ]);

        if ($request->filled('password')) {
            $this->validate($request, [

                'password' => 'confirmed|min:6',

            ]);
            $password = $request->get('password');
            $user->password = bcrypt($password);

            $user->update();
            return back()->with('success','Contreseña actualizada correctamente');
        }
        return back()->with('success','Se ha actualizado correctamente');
    }
}
