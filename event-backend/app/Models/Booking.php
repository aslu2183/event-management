<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'booking_person',
        'booking_email',
        'booking_mobile',
        'booking_event',
        'booking_ticket',
    ];

    public function getEvents(){
        return $this->belongsTo('App\Models\Event','booking_event', 'event_id');
    }

    public function getTickets(){
        return $this->belongsTo('App\Models\EventTicket','booking_ticket','ticket_id');
    }
}
