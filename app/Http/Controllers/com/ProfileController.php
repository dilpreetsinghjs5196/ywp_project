<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\PageContent;
use App\Models\Order;
use App\Models\TherapistBooking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('items.product')->latest()->get();
        $bookings = TherapistBooking::where('user_id', $user->id)
            ->with(['therapist', 'service'])
            ->latest()
            ->get();
        $reviews = Review::where('user_id', $user->id)
            ->with('team')
            ->latest()
            ->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        $contents = PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        return view('site.com.profile', compact('user', 'orders', 'bookings', 'reviews', 'settings', 'contents'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($request->only(['name', 'phone', 'address', 'city', 'state', 'postcode', 'country']));

        return back()->with('success', 'Profile updated successfully!');
    }
}
