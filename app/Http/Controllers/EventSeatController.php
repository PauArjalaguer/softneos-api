<?php

namespace App\Http\Controllers;

use App\Models\EventSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventSeatController extends Controller
{    
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

    public function getEventSeatsStatusByEventId(int $event_id, string $session_id, int $role_id)
    {
        EventSeat::clearUnusedSeats();
        $newSeats = [];
        $seats = EventSeat::getEventSeatsStatusByEventId($event_id,  $session_id, $role_id);

        if ($role_id != 1) {
            //faig que en la vista d' usuari, no es diferencii els seients reservats per l'admin dels que estan reservats per usuari
            foreach ($seats as $s) {
                if ($s['status_name'] == 'Assignada' && $s['session_id'] != $session_id) {
                    $s['status_name'] = 'Reservada';
                    $s['status_color'] = 'grey';
                }
                array_push($newSeats, $s);
            }
            $seats = $newSeats;
        }

        return response()->json($seats, Response::HTTP_OK);
    }
    public function clearUnusedSeats()
    {
        EventSeat::clearUnusedSeats();
    }

    public static function updateEventSeatStatus(Request $request)
    {
        $seat_id = $request->seat_id;
        $event_id = $request->event_id;
        $session_id = $request->session_id;
        $status_id = $request->status_id;

        /*     Netejar seients de l' usuari a altres events. Consultar si fa falta*/
        $seatsInOtherEvents = EventSeat::where('event_id', '!=', $event_id)->where('session_id', $session_id);
        $seatsInOtherEvents->delete();

        $eventSeat = EventSeat::updateEventSeatStatus($seat_id, $event_id, $session_id, $status_id);
        return response()->json($eventSeat, Response::HTTP_OK);
    }

    public static function updateMultipleSeats(int $event_id, string $typeOfSeat, int $number)
    {
        $searchSeatsWithStatusInTheEvent = EventSeat::searchSeatsWithStatusInTheEvent($typeOfSeat, $number, $event_id); //busco seients que tinguin estat pero que no sigui 1 (passadís)
        $searchSeatsWithCorridorStatusInTheEvent = EventSeat::searchSeatsWithCorridorStatusInTheEvent($typeOfSeat, $number, $event_id);  //busco seients que tinguin estat 1 (passadís)

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
            $message = "Passadís creat";
        } else {
            return response()->json(['error' => 'No es poden crear o eliminar passadissos amb butaques actives.'], Response::HTTP_OK);
        }

        if ($searchSeatsWithCorridorStatusInTheEvent == 10) {
            $seatsInColOrRow = EventSeat::seatsInColOrRow($typeOfSeat, $number, $event_id);
            EventSeat::whereIn('seat_id', $seatsInColOrRow)->where('event_id', $event_id)->delete();
            $message =  "Passadís eliminat";
        }
        return response()->json(['success',$message], Response::HTTP_OK);
    }

    public static function getEventSeatSummaryBySession_id(int $event_id, string $session_id, int $role_id)
    {
        $eventSeatSummaryBySession_id = EventSeat::getEventSeatSummaryBySession_id($event_id, $session_id,$role_id);
        return $eventSeatSummaryBySession_id;
    }
   
}
