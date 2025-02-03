<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = User::where('role', 'organizer')
        ->get();
        return view('organizer.index', compact('organizers'));
    }
}
