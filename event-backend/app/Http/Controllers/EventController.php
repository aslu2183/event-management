<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
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
        return Event::with('lineups')->get();
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
        //
    }

    
}
