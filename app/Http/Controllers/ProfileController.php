<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Обновление профиля пользователя
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('dashboard')->with('success', 'Профиль обновлён');
    }
}