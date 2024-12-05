<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if (!$event->volunteers()->where('user_id', Auth::id())->exists() || now()->lessThan($event->EventEnd)) {
            abort(403, 'You are not allowed to review this event.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            // 'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }
}
