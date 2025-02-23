<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    public function updateEventReview(Request $request, Event $event)
    {
        if (!$event->volunteers()
                ->where('user_id', Auth::id())
                ->where('user_acceptance_status', 'accepted')->exists()
            || now()->lessThan($event->EventEnd)) {
            return back()->with('message', 'You are not allowed to review this event.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'user_review' => $request->comment,
            'event_rating' => $request->rating,
        ];

        $event->updateReview($data);

        return back()->with('success', 'Review submitted successfully.');
    }

    public function updateVolunteerReview(Request $request, Event $event, User $volunteer)
    {
        if (!Gate::allows('OrganizeEvent', $event)) abort(404);

        if (!$event->volunteers()->where('event_id', $event->id)->exists() || now()->lessThan($event->EventEnd)) {
            return back()->with('message', 'You are not allowed to review this volunteer.');
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $data = [
            'user_id' => $volunteer->id,
            'event_id' => $event->id,
            'user_rating' => $request->rating,
        ];

        $event->updateUserRating($data);

        return back()->with('success', 'Volunteer review submitted successfully.');
    }
}
