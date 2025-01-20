<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Str;

class UserDetailController extends Controller
{
    //  

    public function create()
    {
        $skills = Skill::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $role = Auth::user()->role;
        return view('auth.form-user-detail', compact('role', 'skills', 'categories'));
    }

    public function store(Request $request)
    {
        $role = $request->user()->role;
        $validated = '';
        $user = $request->user();
        if ($role == 'organizer') {
            $validated = $request->validate([
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'birth_date' => ['required', 'date'],
            ]);
        } else {
            $validated = $request->validate([
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'skills' => ['required'],
                'categories' => ['required'],
                'birth_date' => ['required', 'date'],
            ]);
            $categories = Str::of($validated['categories'])->split('/[\s,]+/');
            $skills = Str::of($validated['skills'])->split('/[\s,]+/');
            $user->categories()->sync($categories);
            $user->skills()->sync($skills);
        }
        // dd($validated);

        // Update user detail
        $user->userDetail()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('events.index');
    }
}
