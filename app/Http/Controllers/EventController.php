<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('is_active', true)->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $file = $request->file('banner');
        $request->user()->events()->create([
            ...$request->validated(),
            ...['banner' => $file->store('/images/events')]
        ]);
        return to_route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {

        $event = Event::with('volunteers')->where('is_active', true)->findOrFail($event->id);
        return view('events.show', compact('event'));
    }

    public function myEvents()
    {
        $events = Auth::user()->events;
        return view('events.my', compact('events'));
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

    public function join(Event $event)
    {
        $event->volunteers()->attach(Auth::id());
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->update(['is_active' => false]);
        return Redirect::route('events.index')->with('success', 'Event deleted successfully');
    }
}
