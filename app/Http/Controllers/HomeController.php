<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $eventsQuery = Event::with(['categories', 'skills'])->where('events.status', true)
        ->where('events.isActive', true)->orderBy('events.created_at', 'desc');

        $events = $eventsQuery->limit(6)->get();
        $categories = Category::limit(6)->get();

        return view('welcome', compact('events', 'categories'));
    }
}
