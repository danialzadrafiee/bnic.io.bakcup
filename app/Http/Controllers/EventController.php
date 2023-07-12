<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $guested_events =  $user->events()->get();
        $created_events = Event::where('user_id', $user->id)->get();
        switch ($request->filter ?? '') {
            case 'invited':
                $created_events = [];
                break;
            case 'created':
                $guested_events = [];
                break;
            default:
                break;
        }
        return view('event.index', compact('created_events', 'guested_events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'content' => 'required',
            'time' => 'required|date|after:yesterday',
            'lng_location' => 'required',
            'accurate_location' => 'required',
            'token' => 'required'
        ]);
        $event = Event::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'title' => $request->title ?? '',
            'image' => $request->image ?? "https://api.dicebear.com/6.x/initials/svg?scale=30&seed=$request->title",
            'content' => $request->content ?? '',
            'time' => $request->time ?? '',
            'lng_location' => $request->lng_location ?? '',
            'accurate_location' => $request->accurate_location ?? '',
            // 'token' => $request->token
            'token' => null
        ]);

        $guests = json_decode($request->guests);

        if ($guests != null) {
            foreach ($guests as $key => $value) {
                $guest = User::where('id', $value)->first();
                $event->users()->attach($guest);
            }
            $event->save();
        }



        return redirect()->route('event.index')->with('success', 'Event created successfully');
    }

    public function show(Request $request)
    {
        $event = Event::find($request->event_id);
        return view('event.show', compact('event'));
    }
}
