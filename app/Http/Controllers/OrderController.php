<?php

namespace App\Http\Controllers;

use App\Models\EventSeat;
use App\Models\Order;
use App\Models\OrderTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {

        //TODO : refactoritzar aquesta funció
        $user_email = $request->usermail;
        $session_id = $request->session_id;
        $user_name = $request->username;


        //CREACIÓ DE TICKETS PER CADA SEIENT ASSIGNAT QUE TÉ L' USUARI EN SESSIÓ
        $assignedSeats = EventSeat::where('session_id', $session_id)->where('seatstatus_id', 4)->get();
        $seatsArray = $assignedSeats->map(function ($seat) {
            return [
                'seat_id' => $seat->seat_id,
                'event_id' => $seat->event_id
            ];
        })->toArray();
        Ticket::insert($seatsArray);

        // UN COP CREATS COM A TICKET ELS MARCO COM A COMPRATS
        EventSeat::where('session_id', $session_id)->update(['seatstatus_id' => 5]);

        //CREO LA COMANDA AMB NOM D' USUARI i EMAIL //  MAIL SEND EL POSO A 1, PERO LA IDEA ES CREAR UNA CUA D' ENVIAMENT PER TENIR CONTROL D'ERRORS
        $order = [
            'mail_send' => 1,
            'order_userEmail' => $user_email,
            'order_userName' => $user_name,
        ];
        $orderCreate = Order::create($order);

        //VINCULO TICKETS A LA COMANDA
        $order_id = $orderCreate->id;
        $insertedTickets = Ticket::whereIn('event_id', array_column($seatsArray, 'event_id'))->get(['id']);
        $ticketsArray = $insertedTickets->map(function ($ticket)  use ($order_id) {
            return [
                'ticket_id' => $ticket->id,
                'order_id' => $order_id
            ];
        })->toArray();
        OrderTicket::insert($ticketsArray);

        //AGAFO LES DADES DE LA COMANDA PER ENVIAR EL MAIL
        $orderTicketInfo = OrderTicket::orderTicketInfo($order_id, $session_id);
        Mail::to($user_email)->send(new SendMail($orderTicketInfo));
    }
}
