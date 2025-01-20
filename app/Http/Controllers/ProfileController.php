<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Skill;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'detail' => $request->user()->userDetail,
            'user_skills' => $request->user()->skills->pluck('id'),
            'user_categories' => $request->user()->categories->pluck('id'),
            'skills' => Skill::where('status', 1)->get(),
            'categories' => Category::where('status', 1)->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->userDetail()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated()
        );
        $request->user()->save();
        $categories = Str::of($request->validated()['categories'])->split('/[\s,]+/');
        $skills = Str::of($request->validated()['skills'])->split('/[\s,]+/');

        $request->user()->skills()->sync($skills);
        $request->user()->categories()->sync($categories);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
