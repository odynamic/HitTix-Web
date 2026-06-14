<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EoRegisterController extends Controller
{
    /**
     * Menampilkan form registrasi EO
     */
    public function showForm()
    {
        return view('auth.eo_register'); // Pastikan file resources/views/auth/eo_register.blade.php ada
    }

    /**
     * Memproses form registrasi EO
     */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_name'     => 'required|string|max:255',
        'username'      => 'required|string|max:50|unique:users,username',
        'user_email'    => 'required|email|unique:users,email',
        'phone'         => 'required|string|max:20',
        'birthdate'     => 'required|date',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'user_password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/[@$!%*#?&]/'
        ],
    ], [
        'user_password.regex' => 'Password harus mengandung minimal satu karakter spesial.'
    ]);

    if ($validator->fails()) {
        return redirect()
            ->route('eo.register.form')
            ->withErrors($validator)
            ->withInput();
    }

    // Upload foto profil
    $profileFilename = null;
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $profileFilename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/profile'), $profileFilename);
    }

    // Simpan data user EO
    User::create([
        'name'            => $request->user_name,
        'username'        => $request->username,
        'email'           => $request->user_email,
        'phone'           => $request->phone,
        'birthdate'       => $request->birthdate,
        'profile_picture' => $profileFilename,
        'password'        => Hash::make($request->user_password),
        'role'            => 'eo',
    ]);

    return redirect()->route('eo.login.form')->with([
        'success' => 'Registrasi berhasil. Silakan login sebagai EO.'
    ]);
  }
}
