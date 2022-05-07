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

// Route::get('/events', function(Request $request){
//     return Event::with('lineups')->get();
// });

// Route::post('/add-event', function(Request $request){
//     $q = Event::create([
//         'event_title'       => 'Aslam',
//         'event_description' => 'check',
//         'event_start'       => '2022-05-07',
//         'event_end'         => '2022-05-27',
//         'event_lineups'     => 6
//     ]);
//     return $q->lineups()->create([
//         'event_line_up_title' => 'Line Up 1',
//         'event_line_up_start' => '13:00:00',
//         'event_line_up_end'   => '14:00:00' 
//     ]);
// });
