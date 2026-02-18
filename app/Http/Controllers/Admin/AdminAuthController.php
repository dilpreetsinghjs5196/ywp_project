<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->hasRole('therapist')) {
                return redirect()->route('therapist.dashboard');
            }
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($user->hasRole('therapist')) {
                $request->session()->regenerate();

                // If intended URL is in the admin area, clear it for therapists
                $intended = session()->get('url.intended');
                if ($intended && str_contains($intended, '/admin')) {
                    session()->forget('url.intended');
                    return redirect()->route('therapist.dashboard');
                }

                return redirect()->intended(route('therapist.dashboard'));
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have administrative or therapist access.',
            ])->withInput($request->only('email'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
