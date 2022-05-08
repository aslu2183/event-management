<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLineUp extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_line_up_id';
    protected $fillable = [
        'event_line_up_title',
        'event_line_up_start',
        'event_line_up_end',
        'event_line_up_eventid'
    ]; 

    public function getEvent(){
        $this->belongsTo('App\Models\Event','event_id','event_line_up_eventid');
    }
}
