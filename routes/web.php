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
    $get = \App\User::where('id',7)->whereHas('roles', function($q) {
        $q->where('roles_id', '=', 3);
    })->with('socialAcounts','roles','car', 'car.subscription.plans.wash_type')->get();
    return $get;
});

Route::get('/auto', function (){
    $cars = \App\Car::where('user_id', 2)->with('subscription.plans.wash_type')->get();
    return response()->json(['cars' => $cars]);
});
Route::get('tipo-lavado', function (){

});
/*=============================================

 =============================================*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
