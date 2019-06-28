<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*=============================================
    TODOS LOS CLIENTES
 =============================================*/

Route::get('/clientes', function (){
    $get = \App\User::whereHas('roles', function($q) {
        $q->where('roles_id', '=', 3);
    })->get();
    return $get;
});


/*=============================================
      CLIENTE CON SU VEHICULO
 =============================================*/
Route::get('/cliente-auto', function (){
    $cars = \App\Car::where('user_id',7)->with('subscription.plans.wash_type')->get();
    return response()->json(['cars' => $cars]);
});

Route::get('/auto', function (){
    $cars = \App\Car::where('user_id', 8)->with('subscription.plans.wash_type')->get();
    return response()->json(['cars' => $cars]);
});
Route::get('/tipo-lavado', function (){
    $get = \App\PlanTypeWash::where('plan_id', 1)->get();
    return $get;
});

Route::get('/orden-carro', function (){
    $orden = \App\Order::where('user_id', 8)->with('suscription.plans.wash_type','planTypeWash')->get();
    return $orden;
});
Route::get('/orden-carro/{id}', function ($id){
    $orden = \App\Order::where('id', $id)->with('suscription.plans.wash_type','planTypeWash','suscription.car')->get();
    return $orden;
});

Route::get('plans', function (){
   $plans =  \App\Plan::with('wash_type')->get();
   return $plans;
});

Route::get('empresas', function (){
    $empresas = \App\Enterprise::with('user')->get();
    return $empresas;
});

Route::get('get-cars', function (){
    $suscripciones = \App\CarSubscription::with('car', 'suscriptions.plans')->whereHas('car.clients', function ($query){
        $query->where('id', '=', 7);
    })->get();
    return $suscripciones;
});


Route::group(['namespace'=>'Backend', 'middleware' => 'admin_permissions'],function (){
    Route::get('/dashboard2310','Dashboard\DashboardController@index')->name('dashboard');
    /*=============================================
    ADMINISTRAR USUARIOS
    =============================================*/
    Route::get('/admin-users','Users\UserController@index')->name('admin-users');
    Route::post('/create-users','Users\UserController@store')->name('admin-create-users');
    Route::put('/update-state-users/{user}/{state}','UserController@update_state_users')->name('update_state_users');
    /*=============================================
    PERFIL USUARIOS
    =============================================*/
    Route::get('/profile/{user}','Users\ProfileController@index')->name('profile_user');
    Route::put('/update-profile-user/{user}','Users\ProfileController@update_profile_users')->name('update_profile_users');
    /*=============================================
    EMPRESAS
    =============================================*/
    Route::get('all-enterprise','Enterprise\EnterpriseController@index')->name('all_enterprise');
    Route::get('datatables-enterprise-all','Enterprise\EnterpriseController@datatables_all_enterprise')->name('datatables-enterprise-all');

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
