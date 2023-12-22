<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Events,Sessions,Attendance};
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class SessionController extends Controller
{
    public function index(Request $request)
    {

        $sessions = Sessions::paginate(15);

        return view('sessions.index', compact('sessions'));
    }

    public function create(Request $request, $eventId = null)
    {
        $events = Events::get();
        return view('sessions.add', compact('eventId','events'));
    }

    public function save(Request $request)
    {

        $request->request->add(['check_valid_session' => true]);

        //unique session creation
        $session = Sessions::where('event_id', $request->event_id)
            ->where(DB::raw('UNIX_TIMESTAMP(start_time)'), '>', strtotime($request->start_time))
            ->where(DB::raw('UNIX_TIMESTAMP(start_time)'), '<', strtotime($request->end_time))
            ->count();
        $rules = [
            'name' => 'required|unique:sessions,name,'.$request->name.'|max:255',
            'start_time' => [
                Rule::prohibitedIf(($session > 0) ? true : false),
            ],
            'end_time' => 'after:start_time',
        ];

        $validated = $request->validate($rules);

        Sessions::updateOrCreate([
            'name' => $request->name,
        ],[
            'name' => $request->name,
            'start_time' => date('Y-m-d g:i:s', strtotime($request->start_time)),
            'end_time' => date('Y-m-d g:i:s', strtotime($request->end_time)),
            'is_active' => ($request->is_active == "on") ? 1 : 0,
            'description' => $request->description,
            'event_id' => $request->event_id
        ]);

        event (new \App\Events\NewEventSessionNotification("New '".$request->name ."' Session Created."));

        return redirect()->route('session.index');
    }

    public function edit(Request $request, $id)
    {

        $events = Events::get();
        $session = Sessions::where('id', $id)->first();

        return view('sessions.edit', compact('session','events'));
    }

    public function delete(Request $request, $id)
    {

        $session = Sessions::where('id', $id)->first();

        if ( !empty($session) ) {

            Attendance::whereIn('session_id', $session->id)->delete();
            Sessions::where('event_id', $session->id)->delete();
        }

        return redirect()->route('event.index');
    }
}
