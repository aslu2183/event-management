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
Route::middleware('auth:api')->post('/get-report-based-on-events','EventController@eventsReport');
Route::middleware('auth:api')->post('/get-report-based-on-tickets','EventController@ticketsReport');
Route::middleware('auth:api')->get('/get-tickets','EventController@listTickets');
Route::middleware('auth:api')->get('/remove-tickets/{id}','EventController@removeTickets');
Route::middleware('auth:api')->get('/remove-event/{id}','EventController@destroy');

Route::middleware('auth:api')->get('/bookings','BookingController@index');
Route::middleware('auth:api')->post('/add-booking','BookingController@store');
Route::middleware('auth:api')->get('/get-booking/{id}','BookingController@show');
Route::middleware('auth:api')->get('/remove-booking/{id}','BookingController@destroy');

Route::middleware('auth:api')->get('/get-dashboard','DashboardController@index');

Route::middleware('auth:api')->get('/get-chart-data','DashboardController@getDataforCharts');





