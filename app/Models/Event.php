<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'event_date', 'event_time', 'event_name', 'event_price', 'event_image'];

    public static function getEventsNotExpired()
    {
        $events = Event::select('events.event_date', 'events.event_time', 'events.id', 'events.event_name','event_image')->whereRaw("CONCAT(event_date, ' ', event_date) > ?", [Carbon::now()->toDateTimeString()])->selectSub(function ($query) {
            $query->selectRaw('COUNT(*)')
                ->from('event_seats')
                ->whereColumn('event_id', 'events.id'); // Referència correcta a la columna 'id' de la taula 'events'
        }, 'seat_count')->get();
        return $events;
    }
}
