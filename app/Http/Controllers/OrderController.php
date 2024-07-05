<?php

namespace App\Http\Controllers;

use App\Models\EventSeat;
use App\Models\Order;
use App\Models\OrderTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function createOrder(int $session_id, string $user_email = 'hotmail@hotmail.com', string $user_name = 'Comprador')
    {
        EventSeat::where('session_id', $session_id)->update(['seatstatus_id' => 5]);
        $assignedSeats = EventSeat::where('session_id', $session_id)->where('seatstatus_id', 5)->get();
        $seatsArray = $assignedSeats->map(function ($seat) {
            return [
                'seat_id' => $seat->seat_id,
                'event_id' => $seat->event_id
            ];
        })->toArray();
        Ticket::insert($seatsArray);

        $order = [
            'mail_send'=>0,
            'order_userEmail' => $user_email,
            'order_userName' => $user_name,
        ];

        $orderCreate = Order::create($order);
        $order_id = $orderCreate->id;

        $insertedTickets = Ticket::whereIn('event_id', array_column($seatsArray, 'event_id'))->get(['id']);
        $ticketsArray = $insertedTickets->map(function ($ticket)  use ($order_id) {
            return [
                'ticket_id' => $ticket->id,
                'order_id' => $order_id
            ];
        })->toArray();
        OrderTicket::insert($ticketsArray);

    }
}
