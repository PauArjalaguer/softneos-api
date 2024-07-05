<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class EventSeat extends Model
{
    use HasFactory;

    public static function clearUnusedSeats()
    {
        $threshold = Carbon::now()->subMinutes(15);
        EventSeat::where('seatstatus_id', 5)
            ->where('created_at', '<', $threshold)
            ->delete();
    }
    public static function getEventSeatsStatusByEventId(int $event_id, string $session_id)
    {
        $seats = Seat::leftJoin('event_seats', function ($join) use ($event_id) {
            $join->on('event_seats.seat_id', '=', 'seats.id')
                ->where('event_seats.event_id', '=', $event_id);
        })
            ->leftJoin('seatstatus', 'seatstatus.id', '=', 'event_seats.seatstatus_id')
            ->leftJoin('events', 'events.id', '=', 'event_seats.event_id')

            ->select('seats.*', 'event_seats.id as eventId', 'seatstatus.status_color', 'seatstatus.status_name',  'event_price', 'session_id')
            ->orderBy('seat_row', 'asc')
            ->orderBy('seat_col', 'asc')
            ->get();
        return $seats;
    }

    public static function updateEventSeatStatus(int $seat_id, int $event_id, string $session_id, $status_id)
    {
        $seat = EventSeat::where('seat_id', $seat_id)->where('event_id', $event_id)->get();
        if (count($seat) > 0) {
            if ($seat[0]->session_id == $session_id) {
                $seat = EventSeat::where('seat_id', $seat_id)->where('event_id', $event_id)->where('session_id', $session_id)->delete();
                return "Seient alliberat.";
            } else {
                return "error";
            }
        } else {
            EventSeat::insertGetId(['seat_id' => $seat_id, 'event_id' => $event_id, 'session_id' => $session_id, 'seatstatus_id' => $status_id]);
            return "Seient assignat.";
        }
    }

    public static function searchSeatsWithStatusInTheEvent(string $typeOfSeat, int $number, int $event_id)
    {
        $searchSeatsWithStatusInTheEvent = EventSeat::join('seats', 'seats.id', '=', 'event_seats.seat_id')
            ->join('seatstatus', 'event_seats.seatstatus_id', 'seatstatus.id')
            ->where('event_seats.event_id', $event_id)
            ->where($typeOfSeat, $number)
            ->where('seatstatus_id', '!=', 1)
            ->select('event_seats.*', 'seats.*', 'seatstatus_id.*')
            ->count();
        return $searchSeatsWithStatusInTheEvent;
    }

    public static function searchSeatsWithCorridorStatusInTheEvent(string $typeOfSeat, int $number, int $event_id)
    {

        $searchSeatsWithCorridorStatusInTheEvent = EventSeat::join('seats', 'seats.id', '=', 'event_seats.seat_id')
            ->join('seatstatus', 'event_seats.seatstatus_id', 'seatstatus.id')
            ->where('event_seats.event_id', $event_id)
            ->where($typeOfSeat, $number)
            ->where('seatstatus_id', '=', 1)
            ->select('event_seats.*', 'seats.*', 'seatstatus_id.*')
            ->count();
        return $searchSeatsWithCorridorStatusInTheEvent;
    }
    public static function seatsInColOrRow(string $typeOfSeat, int $number, int $event_id)
    {
        //elimino primer els que puguin quedar penjats de la fila/columna
        EventSeat::whereExists(function ($query) use ($typeOfSeat, $number) {
            $query->select(DB::raw(1))
                ->from('seats')
                ->whereColumn('seats.id', 'event_seats.seat_id')
                ->where($typeOfSeat, $number);
        })
            ->where('seatstatus_id', 1)
            ->where('event_id', $event_id)
            ->delete();

        return $seats = Seat::where($typeOfSeat, $number)->get(['id']);
    }

    public static function getEventSeatSummaryBySession_id(int $session_id)
    {
        return  EventSeat::join('events', 'events.id', 'event_seats.event_id')->join('seats', 'seats.id', 'event_seats.seat_id')->where('session_id', $session_id)->get();
    }
}
