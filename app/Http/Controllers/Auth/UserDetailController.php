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
        return view('auth.form-user-detail', compact('skills', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:255'],
            // 'city' => ['required', 'string', 'max:255'],
            // 'province' => ['required', 'string', 'max:255'],
            // 'country' => ['required', 'string', 'max:255'],
            // 'address' => ['required', 'string', 'max:255'],
            'skills' => ['required'],
            'categories' => ['required'],
            'birth_date' => ['required', 'date'],
        ]);

        $categories = Str::of($validated['categories'])->split('/[\s,]+/');
        $skills = Str::of($validated['skills'])->split('/[\s,]+/');

        // Update or Create user detail
        $user = $request->user();
        $user->updateOrCreate(
            ['id' => $user->id],
            $request->all()
        );
        $user->categories()->attach($categories);
        $user->skills()->attach($skills);

        return redirect()->route('events.index');
    }
}
