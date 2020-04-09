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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/driverLogin','driverController@login');

Route::post('/driver','driverController@create');
Route::get('/driver','driverController@getAll');
Route::get('/driver/{id}','driverController@getById');
Route::post('/driver/{id}','driverController@updateById');
Route::delete('/driver/{id}','driverController@deleteById');

