<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EoLoginController extends Controller
{
    // Tampilkan form login EO, email bisa otomatis terisi dari session
    public function showLoginForm(Request $request)
    {
        $email = $request->session()->get('email', '');
        return view('auth.login', compact('email'));
    }

    // Proses login EO
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt(array_merge($credentials, ['role' => 'eo']))) {
        $request->session()->regenerate();
return redirect()->route('home')->with('success', 'Selamat datang di HitTix!');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}    // Logout EO
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

return redirect()->route('home');
}
}
