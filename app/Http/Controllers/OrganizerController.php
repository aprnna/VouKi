<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index(Request $request)
    {
        $organizers = User::where('role', 'organizer')
        ->get();

        if($request->input('searchOrganizer')){
            $organizers = User::where('role', 'organizer')
            ->where('name', 'like', '%'.$request->input('searchOrganizer').'%')
            ->get();
        }

        return view('organizer.index', compact('organizers'));
    }

    public function show($id)
    {
        $organizer = User::with(['events'])->findOrFail($id);
        return view('organizer.show', compact('organizer'));
    }
}
