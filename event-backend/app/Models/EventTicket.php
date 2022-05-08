<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;
    protected $primaryKey = 'ticket_id';
    protected $fillable = [
        'ticket_label',
        'ticket_capacity',
        'ticket_price',
        'ticket_event_id',
    ];

    public function getEvent(){
        $this->belongsTo('App\Models\Event','event_id','ticket_event_id');
    }
}
