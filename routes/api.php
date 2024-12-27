<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSeatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);

Route::get('EventSeat/getEventSeatsStatusByEventId/{event_id}/{uuid}/{role_id}', [EventSeatController::class, 'getEventSeatsStatusByEventId']);
Route::post('EventSeat/updateEventSeatStatus', [EventSeatController::class, 'updateEventSeatStatus']);
Route::get('EventSeat/updateMultipleSeats/{event_id}/{typeOfSeats}/{number}', [EventSeatController::class, 'updateMultipleSeats']);
Route::get('EventSeat/getEventSeatSummaryBySession_id/{event_id}/{session_id}/{role_id}', [EventSeatController::class, 'getEventSeatSummaryBySession_id']);
Route::post('Event/updateEventInfo', [EventController::class, 'updateEventInfo']);

Route::post('Order/createOrder', [OrderController::class, 'createOrder']);
Route::get('send-email', function () {
  Mail::to('pau.arjalaguer@gmail.com')->send(new SendMail());
    return 'Test email sent!';

});
Route::post('login', [LoginController::class, 'login']);
