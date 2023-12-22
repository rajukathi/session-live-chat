<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Events,Sessions,Attendance};

class EventController extends Controller
{
    
    public function index(Request $request)
    {

        $events = Events::paginate(15);

        return view('events.index', compact('events'));
    }

    public function create(Request $request)
    {

        return view('events.add');
    }

    public function save(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|unique:events,name,'.$request->name.'|max:255',
        ]);

        Events::updateOrCreate([
            'name' => $request->name,
        ],[
            'name' => $request->name,
            'event_date' => date('Y-m-d g:i:s', strtotime($request->event_date)),
            'is_active' => ($request->is_active == "on") ? 1 : 0,
            'description' => $request->description,
        ]);

        event (new \App\Events\NewEventSessionNotification("New '".$request->name ."' Event Created."));

        return redirect()->route('event.index');
    }

    public function edit(Request $request, $id)
    {

        $event = Events::where('id', $id)->first();

        return view('events.edit', compact('event'));
    }

    public function delete(Request $request, $id)
    {

        $event = Events::where('id', $id)->first();

        if ( !empty($event) ) {

            $sessionIds = Sessions::where('event_id', $event->id)->get()->pluck('session_id')->toArray();

            Attendance::whereIn('session_id', $sessionIds)->delete();
            Sessions::where('event_id', $event->id)->delete();
            Events::where('id', $id)->delete();
        }

        return redirect()->route('event.index');
    }

}
