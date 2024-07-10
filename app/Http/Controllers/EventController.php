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
    public  function updateEventInfo(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_image' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'event_price' => 'required|integer',
        ]);

        $record = Event::find($request->event_id);
        if ($record) {
            $record->update($validatedData);
            return response()->json(['message' => 'Esdeveniment actualitzat']);
        } else {
            Event::insert($validatedData);

            return response()->json(['message' => 'Esdeveniment creat']);
        }
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
