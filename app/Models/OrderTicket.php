<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    use HasFactory;
    public static function orderTicketInfo(int $order_id, string $session_id)
    {
        $orderTicketInfo = OrderTicket::join('orders', 'orders.id', '=', 'order_tickets.order_id')
            ->join('tickets', 'tickets.id', '=', 'order_tickets.ticket_id')
            ->join('seats', 'seats.id', '=', 'tickets.seat_id')
            ->join('event_seats', 'event_seats.seat_id', '=', 'tickets.seat_id')
            ->join('events', 'events.id', '=', 'event_seats.event_id')
            ->select('events.event_name', 'events.event_date', 'events.event_time', 'seats.seat_row', 'seats.seat_col', 'order_userName', 'event_price')
            ->where('session_id', $session_id)
            ->where('orders.id', $order_id)->get();
        return $orderTicketInfo;
    }
}
