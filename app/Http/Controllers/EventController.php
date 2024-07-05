<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return  $events = Event::getEventsNotExpired();
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
    public function store(SaveEventRequest $request)
    {
        $event = Event::create($request->validated());
        //return response()->json($expense,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveEventRequest $request, Event $event)
    {
        $event_id = Event::findOrFail($event);
        $event_id->update($request->validated());
       // return response()->json($event_id, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event_id = Event::findOrFail($event);
        $event_id->delete();
    }
}
