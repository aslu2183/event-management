<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $events   = Event::orderBy('created_at', 'desc')->take(10)->get();
        $bookings = Booking::orderBy('created_at', 'desc')->take(10)->get();
        
        return ['events' => $events , 'bookings' => $bookings];
    }
}
