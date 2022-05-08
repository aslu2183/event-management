<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $events       = Event::orderBy('created_at', 'desc')->take(10)->get();
        $bookings     = Booking::with('getEvents')->orderBy('created_at', 'desc')->take(10)->get();
        $data         = DB::select('CALL get_data_for_charts()');
        $user_count   = User::count();
        $events_count = Event::count();
        $booking_count= Booking::count();
        $ticket_count = EventTicket::count();
         
              
        return [
            'events' => $events , 
            'bookings' => $bookings, 
            'chart_data' => $data, 
            'user_cnt'   => $user_count,
            'events_cnt' => $events_count,
            'booking_cnt'=> $booking_count,
            'tickets_cnt'=> $ticket_count
        ];
    }

    public function getDataforCharts(){
        return DB::select('CALL get_data_for_charts()');
    }
}
