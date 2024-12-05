<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    // public function store(Request $request, Event $event)
    // {
    //     if (Review::where('user_id', Auth::id())->where('event_id', $event->id)->exists()) {
    //         return back()->with('message', 'You have already reviewed this event.');
    //     }

    //     if (!$event->volunteers()->where('user_id', Auth::id())->exists() || now()->lessThan($event->EventEnd)) {
    //         return back()->with('message', 'You are not allowed to review this event.');
    //     }

    //     $request->validate([
    //         'comment' => 'required|string|max:500',
    //         'rating' => 'required|integer|between:1,5',
    //     ]);

    //     Review::create([
    //         'user_id' => Auth::id(),
    //         'event_id' => $event->id,
    //         'comment' => $request->comment,
    //         'rating' => $request->rating,
    //     ]);

    //     return back()->with('success', 'Review submitted successfully.');
    // }

    public function storeEventReview(Request $request, Event $event)
    {
        if (Review::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->where('type', Review::TYPE_EVENT)
            ->exists()) {
            return back()->with('message', 'You have already reviewed this event.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'type' => Review::TYPE_EVENT,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }

    public function storeVolunteerReview(Request $request, Event $event, User $volunteer)
    {
        if (!Gate::allows('OrganizeEvent', $event)) abort(404);

        if (Review::where('user_id', $volunteer->id)
            ->where('event_id', $event->id)
            ->where('type', Review::TYPE_VOLUNTEER)
            ->exists()) {
            return back()->with('message', 'You have already reviewed this volunteer.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'user_id' => $volunteer->id,
            'event_id' => $event->id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'type' => Review::TYPE_VOLUNTEER,
        ]);

        return back()->with('success', 'Volunteer review submitted successfully.');
    }
}
