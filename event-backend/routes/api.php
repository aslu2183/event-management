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

Route::post('/login','LoginController@Login');
Route::middleware('auth:api')->get('/logout','LoginController@Logout');

Route::middleware('auth:api')->get('/events','EventController@index');
Route::middleware('auth:api')->post('/add-event','EventController@store');
Route::middleware('auth:api')->post('/create-event-ticket','EventController@createTickets');
Route::middleware('auth:api')->get('/get-event-tickets/{id}','EventController@eventTickets');


Route::middleware('auth:api')->get('/bookings','BookingController@index');
Route::middleware('auth:api')->post('/add-booking','BookingController@store');
Route::middleware('auth:api')->get('/get-booking/{id}','BookingController@show');


