<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Event;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

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

    function createAnswer(Event $event)
    {
        // check apakah user sudah melakukan answer di event yang sama atau belum
        $isRegistered = $event->volunteers()->where('user_id', Auth::id())->exists();
        if ($isRegistered) {
            return redirect()->route('events.show', $event)->with('error', 'You have already registered for the event');
        }
        $questions = $event->questions()->where('status', 1)->get();
        return view('events.register.answer', compact('event', 'questions'));
    }

    function storeAnswer(Request $request, Event $event)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:255',
        ]);

        foreach ($request->answers as $questionId => $answerText) {
            Answer::updateOrCreate(
                [
                    'user_id' => Auth::user()->id,
                    'question_id' => $questionId,
                ],
                [
                    'answer' => $answerText,
                ]
            );
        }

        $event->volunteers()->attach(Auth::id());

        return redirect()->route('events.show', $event)->with('success', 'You have successfully registered for the event');
    }
}
