<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Booking;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Event::with('lineups','tickets')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_title' => ['required'],
            'event_start' => ['required'],
            'event_end'   => ['required'],
            'line_ups'    => ['required']
        ]);

        $data = $request->all();
        $found= false;
        foreach($data['line_ups'] as $row){
            if($row['event_line_up_title'] === NULL || $row['event_line_up_title'] === ''){
                $found = true;
            }
            if($row['event_line_up_start'] === NULL || $row['event_line_up_start'] === ''){
                $found = true;
            }
            if($row['event_line_up_end'] === NULL || $row['event_line_up_end'] === ''){
                $found = true;
            }
        }

        if($found){
            throw ValidationException::withMessages([
                'line_ups' => 'Line up fields cannot be empty',
            ]);
        }
        $line_ups = $data['line_ups'];
        unset($data['line_ups']);
        $data['event_lineups'] = count($line_ups);
        
        $q = Event::create($data);
        return $q->lineups()->createMany($line_ups);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::where("booking_event",$id)->get();
        $tickets = EventTicket::where("ticket_event_id",$id)->get();
        if(count($booking) <= 0 && count($tickets) <= 0){
            $event = Event::find($id);
            $event->lineups()->delete();
            return $event->delete();
        }
        return 0;
    }


    public function createTickets(Request $request){
        $request->validate([
            'ticket_label'    => ['required'],
            'ticket_capacity' => ['required'],
            'ticket_price'    => ['required'],
        ]);
        $data     = $request->all();
        $event_id = $data['event_id'];
        unset($data['event_id']); 

        $q = Event::find($event_id);
        return $q->tickets()->create($data);
    }

    public function eventTickets($id){
        return Event::with('tickets')->find($id);
    }

    public function listTickets(){
        return EventTicket::all();
    }

    public function eventsReport(Request $request){
        $request->validate([
            'event'     => ['required'],
        ]);
        $booking = Booking::with('getTickets')->where('booking_event',$request->event);
        if($request->from_date && $request->to_date){
            $request->validate([
                'from_date' => ['before_or_equal:to_date'],
                'to_date'   => ['after_or_equal:from_date']
            ],[
                'from_date.before_or_equal' => 'Invalid Date Range',
                'to_date.after_or_equal'    => 'Invalid Date Range' 
            ]);
            $booking->whereDate('created_at','>=',$request->from_date);
            $booking->whereDate('created_at','<=',$request->to_date);
        }
        return $booking->get();
        
    }

    public function ticketsReport(Request $request){
        $request->validate([
            'ticket'     => ['required'],
        ]);
        $booking = Booking::with('getEvents')->where('booking_ticket',$request->ticket);
        if($request->from_date && $request->to_date){
            $request->validate([
                'from_date' => ['before_or_equal:to_date'],
                'to_date'   => ['after_or_equal:from_date']
            ],[
                'from_date.before_or_equal' => 'Invalid Date Range',
                'to_date.after_or_equal'    => 'Invalid Date Range' 
            ]);
            $booking->whereDate('created_at','>=',$request->from_date);
            $booking->whereDate('created_at','<=',$request->to_date);
        }
        return $booking->get();
        
    }

    public function removeTickets($id){
        $booking = Booking::where("booking_ticket",$id)->get();
        if(count($booking) <= 0){
            return EventTicket::where('ticket_id', $id)->delete();
        }
        return 0;
        
    }

    
}
