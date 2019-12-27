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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\AuthController@store');
Route::post('/login','Api\AuthController@index');
Route::get('/get-users','Api\AuthController@get_users');
Route::get('/single-user/{id}','Api\AuthController@single_user');
Route::get('/delete-user/{id}','Api\AuthController@delete_user');
Route::post('/update-user','Api\AuthController@update_user');