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

        $event = Event::create([
            'user_id' => $request->creator,
            'type' => $request->type,
            'title' => $request->title ?? '', // need be required TODO
            'image' => $request->image ?? "https://api.dicebear.com/6.x/initials/svg?scale=30&seed=$request->title",
            'content' => $request->content ?? '', // need be required TODO
        ]);
        $guests = json_decode($request->guests);
        foreach ($guests as $key => $value) {
            $guest = User::where('id', $value)->first();
            $event->users()->attach($guest);
        }
        $event->save();
        return redirect()->route('event.index')->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $event = Event::find($request->event_id);
        return view('event.show', compact('event'));
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
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
