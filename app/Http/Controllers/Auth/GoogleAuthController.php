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

        $user = User::updateOrCreate(
            ['google_id' => $userGoogle->id],
            [
                'name' => $userGoogle->name,
                'email' => $userGoogle->email,
                'password' => Str::password(12),
            ]
        );
        Auth::login($user);
        return redirect()->intended(route('event.index', absolute: false));
    }
}
