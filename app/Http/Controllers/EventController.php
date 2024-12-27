<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  
    public function index()
    {

        return  $events = Event::getEventsNotExpired();
    }

  
    public function store(SaveEventRequest $request)
    {
        $event = Event::create($request->validated());
    }

    public function show(Event $event)
    {
        return $event;
    }

  
    public  function updateEventInfo(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_image' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'event_price' => 'required|decimal:0,2',
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
   
    public function destroy(Event $event)
    {
        $event_id = Event::findOrFail($event);
        $event_id->delete();
    }
}
