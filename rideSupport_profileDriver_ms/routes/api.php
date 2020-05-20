<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});
*/

Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::get('/driver','driverController@getAll');
    Route::get('/driver/{id}','driverController@getById');
    Route::delete('/driver/{id}','driverController@deleteById');

    Route::post('/driver/logout','driverController@logout');
});

//CUSTOM ROUTES
Route::post('/driver/login','driverController@authenticate');

Route::post('/driver','driverController@register');


Route::put('/driver/{id}','driverController@updateById');


