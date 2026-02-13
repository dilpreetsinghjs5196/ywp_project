<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TherapistBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TherapistDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $therapist = Team::where('email', $user->email)->first();

        if (!$therapist) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Therapist record not found for this user.']);
        }

        $bookings = TherapistBooking::where('therapist_id', $therapist->id)
            ->where('payment_status', 'paid')
            ->orderBy('booking_date', 'desc')
            ->limit(5)
            ->get();

        $totalEarnings = TherapistBooking::where('therapist_id', $therapist->id)
            ->where('payment_status', 'paid')
            ->sum('amount');

        $totalClients = TherapistBooking::where('therapist_id', $therapist->id)
            ->count();

        return view('therapist.dashboard', compact('therapist', 'bookings', 'totalEarnings', 'totalClients'));
    }

    public function profile()
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        return view('therapist.profile', compact('therapist'));
    }

    public function updateProfile(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'fees' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $therapist->update($request->all());

        return back()->with('success', 'Profile updated successfully.');
    }

    public function clients()
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $clients = TherapistBooking::where('therapist_id', $therapist->id)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('therapist.clients', compact('clients'));
    }

    public function availability()
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $availability = $therapist->availability ?? [];
        return view('therapist.availability', compact('therapist', 'availability'));
    }

    public function updateAvailability(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();

        // request format: availability[YYYY-MM-DD] = "10:00 AM, 11:00 AM"
        $formattedAvailability = [];
        if ($request->has('availability')) {
            foreach ($request->availability as $date => $times) {
                if (!empty($times)) {
                    // Convert comma separated string to array and trim whitespace
                    $timeArray = array_map('trim', explode(',', $times));
                    $formattedAvailability[$date] = $timeArray;
                }
            }
        }

        $therapist->update(['availability' => $formattedAvailability]);

        return back()->with('success', 'Availability updated successfully.');
    }
}
