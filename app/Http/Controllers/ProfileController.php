<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // PERFIL
    public function index()
    {
        $my_tips = auth()->user()->tips;
        $user = Auth::user();
        $favorites = $user->likedTips ?? collect();

        return view('user.profile', compact('user', 'my_tips', 'favorites'));
    }

    // CUENTA
    public function account()
    {
        return view('user.account');
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Solo actualizar contraseña si se escribió algo
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updateAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $user = auth()->user();

    // borrar anterior (opcional)
    if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
    }

    // guardar nueva
    $path = $request->file('avatar')->store('avatars', 'public');

    $user->avatar = $path;
    $user->save();

    return back()->with('success', 'Updated profile photo');
}
}