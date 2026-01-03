<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LOGIN FORMA
    public function showLogin()
    {
        return view('auth.login');
    }

    // LOGIN LOGIKA
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('proizvodni-procesi.index');
        }

        return back()->withErrors([
            'email' => 'Pogrešan email ili lozinka.',
        ]);
    }

    // REGISTER FORMA
    public function showRegister()
    {
        return view('auth.register');
    }

    // REGISTER LOGIKA
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role' => ['required', 'in:user,admin'], // validacija uloge
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        // Automatski login nakon registracije
        Auth::login($user);

        return redirect()->route('proizvodni-procesi.index');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
