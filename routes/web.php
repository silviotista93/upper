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
/*=============================================

 =============================================*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
