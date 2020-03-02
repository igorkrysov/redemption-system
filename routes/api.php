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

Route::post('login', 'API\AuthController@login')->name('login');

Route::middleware('auth:api')->group(function() {
    Route::post('/ticket/create', 'API\RedemptionController@createTicket')->name('ticket.create');
    Route::post('/ticket/redeem', 'API\RedemptionController@redeemTicket')->name('ticket.redeem');

    Route::post('/logout', 'API\AuthController@logout')->name('logout');
});