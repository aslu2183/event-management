<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'event_title',
        'event_description',
        'event_start',
        'event_end',
        'event_lineups'
    ];

    public function lineups(){
        return $this->hasMany('App\Models\EventLineUp','event_line_up_eventid','event_id');
    }

    public function tickets(){
        return $this->hasMany('App\Models\EventTicket','ticket_event_id','event_id');
    }
}
