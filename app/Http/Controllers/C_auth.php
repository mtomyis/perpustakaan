<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_auth extends Controller
{
    public function login()
    {
        // dd(Auth::user()->role);
        // session()->invalidate();
        // session()->regenerateToken();
        if (Auth::check()) {
            $role = Auth::user()->role;
    
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'kepala_sekolah' => redirect()->route('kepala.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                default => abort(403, 'Unauthorized'),
            };
        }
    
        return view('auth.v_login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // dd(Auth::user());

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->role == 'kepala_sekolah') {
                return redirect()->route('kepala.dashboard');
            }
            if (Auth::user()->role == 'siswa') {
                return redirect()->route('siswa.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
