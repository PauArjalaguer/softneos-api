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
        $events = Event::whereRaw("CONCAT(event_date, ' ', event_date) > ?", [Carbon::now()->toDateTimeString()])->get();
        return $events;
    }
}
