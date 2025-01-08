<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    //  

    public function create()
    {
        return view('auth.form-user-detail');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
        ]);
        // Update or Create user detail
        $user = $request->user();
        $user->userDetail()->updateOrCreate(
            ['user_id' => $user->id],
            $request->all()
        );

        return redirect()->route('events.index');
    }
}
