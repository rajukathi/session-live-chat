<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Events,Sessions,Attendance,User};

class AttendanceController extends Controller
{
    public function index(Request $request)
    {

        $events = Events::with('sessions')->paginate(15);

        return view('list', compact('events'));
    }

    public function joinSession(Request $request, $eventId, $sessionId)
    {

        $events = Events::with('sessions')->get();
        $currentEvent = $events->where('id', $eventId)->first();
        $currentSession = $currentEvent->sessions->where('id', $sessionId)->first();
        $sessionName = "You joined session room name '".$currentSession->name."' of '".$currentEvent->name."' event.";
        
        $user = auth()->user();
        $searchSaveArr = [
            'email_id' => $user->email,
            'session_id' => $sessionId,
        ];
        Attendance::updateOrCreate($searchSaveArr,$searchSaveArr);
        event (new \App\Events\GeneralNotification(json_encode([
            'username' => $user->name,
            'useremail' => $user->email,
            'usermessage' => '',
        ]), $sessionId));

        return view('welcome', compact('events','user','sessionId','sessionName'));
    }

    public function sendMessage(Request $request)
    {
        $user = User::where('email', $request->useremail)->first();
        if( $user ) {

            event (new \App\Events\GeneralNotification(json_encode($request->except('_token')), $request->session_id));
        }

        return response()->json($request->all());
    }
}
