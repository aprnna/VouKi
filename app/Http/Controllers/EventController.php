<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Review;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('isOrganizer');
        return view('events.form', [
            'event' => new Event(),
            'skills' => Skill::where('status', 1)->get(),
            'categories' => Category::where('status', 1)->get(),
            'page_meta' => [
                'title' => 'Create Event',
                'description' => 'Create a new event',
                'method' => 'POST',
                'url' => Route('events.store')
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $categories = Str::of($request->validated()['categories'])->split('/[\s,]+/');
        $skills = Str::of($request->validated()['skills'])->split('/[\s,]+/');
        $file = $request->file('banner');
        $event = $request->user()->events()->create([
            ...$request->validated(),
            ...['banner' => $file->store('/images/events', 'public')]
        ]);
        $event->categories()->attach($categories);
        $event->skills()->attach($skills);

        return Redirect::route('events.index')->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = Event::with(['volunteers' => function($query) {
            $query->select('users.*', 'user_acceptance_status');
        }])->findOrFail($event->id);
        return view('events.show', compact('event'));
    }

    public function myEvents()
    {
        Gate::authorize('isOrganizer');
        $events = Auth::user()->events;
        return view('events.my', compact('events'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function eventVolunteers(Event $event)
    {
        if (!Gate::allows('OrganizeEvent', $event)) abort(404);
        // $volunteers = $event->volunteers;
        $volunteers = $event->volunteers()->withPivot('user_rating')->get();
        $all_users_rating = $event->volunteers()->select('user_id', 'user_rating')->get()->keyBy('user_id');
        return view('events.volunteers', compact('volunteers', 'event', 'all_users_rating'));
    }

    public function edit(Event $event)
    {
        if (!Gate::allows('OrganizeEvent', $event)) abort(404);

        return view('events.form', [
            'event' => $event,
            'page_meta' => [
                'title' => 'Edit Event',
                'description' => 'Edit a event',
                'method' => 'PUT',
                'url' => Route('events.update', $event)
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return Redirect::route('events.index')->with('success', 'Event updated successfully');
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
