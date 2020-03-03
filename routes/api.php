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


Route::namespace('Api')->group(function() {
    /*
    Route::post('/contacts', 'ContactController@store');
    Route::get('/contacts/{id}', 'ContactController@show');
    Route::put('/contacts/{id}', 'ContactController@update');
    Route::delete('/contacts/{id}', 'ContactController@destroy');
    */
    Route::resource('/contacts', 'ContactController', ['except' => 'edit']);
    Route::resource('/addresses', 'AddressController', ['except' => 'edit']);
    Route::resource('/people', 'PersonController', ['except' => 'edit']);
});
