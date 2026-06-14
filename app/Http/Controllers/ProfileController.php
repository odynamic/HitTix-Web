<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable|string',
            'new_password'     => ['nullable', 'string', Password::min(8)->letters()->numbers()->mixedCase(), 'confirmed'],
        ]);

        // Update foto jika diupload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos');
            $user->profile_photo = $path;
        }

        // Update password jika ingin diganti
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }

            $user->password = Hash::make($request->new_password);
        }

        // Update info lain
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui');
    }
}
