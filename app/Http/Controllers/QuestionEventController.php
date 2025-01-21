<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Event;

class QuestionEventController extends Controller
{
    function create(Event $event)
    {
        return view('events.form-question', [
            'event' => $event,
            'questions' => $event->questions()->where('status', 1)->get(),
        ]);
    }
    function store(Request $request, Event $event)
    {
        $request->validate([
            'question' => ['required', 'string', 'max:255'],
        ]);
        $event->questions()->create($request->all());
        return redirect()->back();
    }
    function edit()
    {
        return view('questionEvent.edit');
    }
    function update(Questions $question, Request $request)
    {
        $request->validate([
            'question' => ['required', 'string', 'max:255'],
        ]);
        $question->question = $request->question;
        $question->save();
        return redirect()->back();
    }

    function destroy(Questions $question)
    {
        $question->status = 0;
        $question->save();
        return redirect()->back();
    }
}
