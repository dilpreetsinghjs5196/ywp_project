<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Models\SiteSetting;
use App\Models\PageContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('com.profile');
        }
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = $this->getStoreContents();
        return view('site.com.login', compact('settings', 'contents'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            CartItem::syncSessionCart(Auth::id());
            return redirect()->intended(route('com.profile'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('com.profile');
        }
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = $this->getStoreContents();
        return view('site.com.register', compact('settings', 'contents'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        CartItem::syncSessionCart($user->id);

        return redirect()->route('com.profile')->with('success', 'Account created successfully!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('com.home');
    }

    private function getStoreContents()
    {
        return PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });
    }
}
