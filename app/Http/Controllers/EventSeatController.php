<?php

namespace App\Http\Controllers;

use App\Models\EventSeat;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSeat $eventSeat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSeat $eventSeat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSeat $eventSeat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSeat $eventSeat)
    {
        //
    }

    public function getEventSeatsStatusByEventId(int $event_id, string $session_id, int $role_id)
    {
        $this->clearUnusedSeats();
        $newSeats = [];
        $seats = EventSeat::getEventSeatsStatusByEventId($event_id,  $session_id, $role_id);

        /*  if ($role_id != 1) {
            //faig que en la vista d' usuari, no es diferencii els seients reservats per l'admin dels que estan reservats per usuari
            foreach ($seats as $s) {
                if ($s['status_name'] == 'Assignada' && $s['session_id'] != $session_id) {
                    $s['status_name'] = 'Reservada';
                    $s['status_color'] = 'gray';
                }
                array_push($newSeats, $s);
            }
            $seats = $newSeats;
        } */

        return response()->json($seats, Response::HTTP_OK);
    }
    public function clearUnusedSeats()
    {
        EventSeat::clearUnusedSeats();
    }

    public static function updateEventSeatStatus(int $seat_id, int $event_id, string $session_id, int $status_id)
    {
        /*     Netejar seients de l' usuari a altres events. Consultar si fa falta
    $seatsInOtherEvents = EventSeat::where('event_id', '!=', $idEvent)->where('session_id', $session_id);
        $seatsInOtherEvents->delete(); */
        return  EventSeat::updateEventSeatStatus($seat_id, $event_id, $session_id, $status_id);
    }

    public static function updateMultipleSeats(int $event_id, string $typeOfSeat, int $number)
    {
        $searchSeatsWithStatusInTheEvent = EventSeat::searchSeatsWithStatusInTheEvent($typeOfSeat, $number, $event_id);
        $searchSeatsWithCorridorStatusInTheEvent = EventSeat::searchSeatsWithCorridorStatusInTheEvent($typeOfSeat, $number, $event_id);

        if ($searchSeatsWithStatusInTheEvent == 0) {
            $seatsInColOrRow = EventSeat::seatsInColOrRow($typeOfSeat, $number, $event_id);

            $seatsInColOrRowToInsert = $seatsInColOrRow->map(function ($seat)  use ($event_id) {
                return [
                    'seat_id' => $seat->id,
                    'event_id' => $event_id,
                    'seatstatus_id' => 1,
                ];
            })->toArray();
            EventSeat::insert($seatsInColOrRowToInsert);
        } else {
            return "No es poden eliminar fileres o columnes amb seient ocupat o reservat";
        }

        if ($searchSeatsWithCorridorStatusInTheEvent == 10) {
            $seatsInColOrRow = EventSeat::seatsInColOrRow($typeOfSeat, $number, $event_id);
            EventSeat::whereIn('seat_id', $seatsInColOrRow)->where('event_id', $event_id)->delete();
        }
    }

    public static function getEventSeatSummaryBySession_id(string $session_id)
    {
        $eventSeatSummaryBySession_id = EventSeat::getEventSeatSummaryBySession_id($session_id);
        return $eventSeatSummaryBySession_id;
    }
}
