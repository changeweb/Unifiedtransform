<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;

class EventController extends Controller
{
    use SchoolSession;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $currentSchoolSessionId = $this->getSchoolCurrentSession();

            $data = Event::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->where('session_id', $currentSchoolSessionId)
                    ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('events.index');
    }

    public function calendarEvents(Request $request)
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $event = null;
        switch ($request->type) {
            case 'create':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'session_id' => $currentSchoolSessionId
                ]);
                break;

            case 'edit':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();
                break;

            default:
                break;
        }
        dd($event);
        return response()->json($event);
    }
}
