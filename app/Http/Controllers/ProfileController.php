<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('avatars', $filename, 'public');
            $request->user()->avatar = 'avatars/' . $filename;
        }
    
        $request->user()->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}