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
    public function index(Request $request)
    {
        $eventsQuery = Event::with(['categories', 'skills'])->where('events.status', true)
        ->where('events.isActive', true)->orderBy('events.created_at', 'desc');

        $categories = Category::all();

        $categoryId = $request->input('category');

        if ($categoryId) {
            $eventsQuery->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        $events = $eventsQuery->get();

        // Cek apakah filter ada
        if ($request->input('filter') === 'recommendation') {
            if (!Auth::check() || Auth::user()->role !== 'volunteer') {
                return redirect()->route('events.index');
            }

            $user = Auth::user();

            // Ambil kategori dan skill user
            $preferredCategories = $user->categories()->pluck('id')->toArray();
            $preferredSkills = $user->skills()->pluck('id')->toArray();

            $events = $events->filter(function ($event) use ($preferredCategories, $preferredSkills) {
                // Apakah ada kesamaan kategori dan skill antara user dan event
                $hasCategory = $event->categories->pluck('id')->intersect($preferredCategories)->isNotEmpty();
                $hasSkill = $event->skills->pluck('id')->intersect($preferredSkills)->isNotEmpty();

                if ($hasCategory || $hasSkill) {
                    // Hitung kesamaaan kategori dan skill
                    $categoryMatches = $event->categories->pluck('id')->intersect($preferredCategories)->count();
                    $skillMatches = $event->skills->pluck('id')->intersect($preferredSkills)->count();
                    $totalMatches = $categoryMatches + $skillMatches;
                    $event->total_matches = $totalMatches;

                    return $event;
                }
            })->sortByDesc('total_matches');

        }
        return view('events.index', compact('events', 'categories'));
    }

    public function nearest(Request $request)
    {
        // dd($request);
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        $categories = Category::all();

        $distance = $request->input('distance');
        switch ($distance) {
            case '10km':
                $distance = 10;
                break;
            case '100km':
                $distance = 100;
                break;
            case '1000km':
                $distance = 1000;
                break;
            default:
                $distance = 100000; #100000 km
        }

        $eventsQuery = Event::selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$userLatitude, $userLongitude, $userLatitude])
            ->where('status', true)
            ->where('isActive', true)
            ->having('distance', '<=', $distance)
            ->orderBy('distance');

        $categoryId = $request->input('category');

        if ($categoryId) {
            $eventsQuery->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }



        $events = $eventsQuery->get();

        return view('events.near', compact('events', 'categories', 'userLatitude', 'userLongitude'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Gate::authorize('isOrganizer');
        $progress = $request->query('step', false);
        return view('events.form', [
            'event' => new Event(),
            'skills' => Skill::where('status', 1)->get(),
            'categories' => Category::where('status', 1)->get(),
            'user_skills' => collect([]),
            'user_categories' => collect([]),
            'page_meta' => [
                'title' => 'Create Event',
                'description' => 'Create a new event',
                'progress' => $progress,
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

        return Redirect::route($request->validated()["redirect"], [$event, 'step' => 2])->with('status', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = Event::with(['volunteers' => function ($query) {
            $query->select('users.*', 'user_acceptance_status');
        }])->findOrFail($event->id);
        return view('events.show', compact('event'));
    }

    public function myEvents()
    {
        Gate::authorize('isOrganizer');
        $user = Auth::user();
        $events = $user->events->map(function ($event) {
            $event->total_register = $event->volunteers()->count();
            $event->total_volunteer = $event->volunteers()->wherePivot('user_acceptance_status', 'accepted')->count();
            return $event;
        });
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

    public function edit(Request $request, Event $event)
    {
        if (!Gate::allows('OrganizeEvent', $event)) abort(404);
        $progress = $request->query('step', false);
        return view('events.form', [
            'event' => $event,
            'skills' => Skill::where('status', 1)->get(),
            'categories' => Category::where('status', 1)->get(),
            'user_skills' => $event->skills->pluck('id'),
            'user_categories' => $event->categories->pluck('id'),
            'page_meta' => [
                'title' => 'Edit Event',
                'description' => 'Edit a event',
                'progress' => $progress,
                'method' => 'PUT',
                'url' => Route('events.update', $event),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        $categories = Str::of($request->validated()['categories'])->split('/[\s,]+/');
        $skills = Str::of($request->validated()['skills'])->split('/[\s,]+/');
        $event->categories()->sync($categories);
        $event->skills()->sync($skills);
        return Redirect::route($request->validated()['redirect'], $event)->with('status', 'success');
    }

    public function join(Event $event)
    {
        return view('events.register.answer', compact('event'));

        // $event->volunteers()->attach(Auth::id());
        // return back();
    }
    public function status(Event $event)
    {
        return view('events.actived-event', compact('event'));
    }
    public function activateEvent(Event $event)
    {
        $event->update(['isActive' => true]);
        return back()->with('status', 'Event activated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->update(['status' => false]);
        return Redirect::route('events.index')->with('status', 'Event deleted successfully');
    }
    public function eventRegister(Event $event)
    {
        $registerEvent = $event->volunteers()->get();
        return view('events.register.list', compact('event', 'registerEvent'));
    }
    public function eventRegisterDetail(Event $event, User $user)
    {
        $questions = $event->questions()->get();

        foreach ($questions as $question) {
            $question->userAnswer = $question->singleAnswer($user);
        }
        return view('events.register.show', compact('event', 'user', 'questions'));
    }
    public function acceptanceStatus(Event $event, User $user, Request $request)
    {
        $status = $request->query('status', 'pending');
        $event->volunteers()->updateExistingPivot($user->id, [
            'user_acceptance_status' => $status,
        ]);
        return Redirect::route('events.register', $event)->with('status', 'Status updated successfully');
    }
}
