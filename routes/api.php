<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'auth', 'namespace'=>'Movil'], function () {

    /*=============================================
        RUTAS PARA LOGIN REDES SOCIALES
    =============================================*/
    Route::post('login-facebook', 'AuthController@loginFacebook');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');



    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('user-roles', 'AuthController@userRol');
    });
});

Route::group(['middleware' => 'auth:api','prefix' => 'profile', 'namespace'=>'Movil'], function () {
    Route::post('update', 'UserController@update');
    Route::post('update-password', 'UserController@updatePassword');
});

Route::group(['middleware' => 'auth:api','prefix' => 'car', 'namespace'=>'Movil'], function () {
    Route::get('cars', 'CarController@index');
    Route::get('add-car', 'CarController@store');
});

Route::get('/test','Movil\CarController@index');
