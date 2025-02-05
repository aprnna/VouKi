<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;


class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $userGoogle = Socialite::driver('google')->user();

        $user = User::where('google_id', $userGoogle->id)->orWhere('email', $userGoogle->email)->first();

        if ($user) {
            // User already exists, log them in
            $user->update(['google_id' => $userGoogle->id]);
            Auth::login($user);
            return redirect()->intended(route('home.index', absolute: false));
        } else {
            // User does not exist, create a new user
            $user = User::create([
                'name' => $userGoogle->name,
                'email' => $userGoogle->email,
                'google_id' => $userGoogle->id,
                'password' => Str::random(12),
            ]);
            Auth::login($user);
            return redirect()->intended(route('user-detail.create', absolute: false));
        }
    }
}
