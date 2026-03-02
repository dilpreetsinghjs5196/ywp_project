<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TherapistBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            ->orderBy('booking_date', 'desc')
            ->limit(5)
            ->get();

        $totalEarnings = TherapistBooking::where('therapist_id', $therapist->id)
            ->where('payment_status', 'paid')
            ->sum('amount');

        $totalClients = TherapistBooking::where('therapist_id', $therapist->id)
            ->count();

        $approvedReviewsCount = $therapist->approvedReviews()->count();
        $averageRating = $therapist->reviews()->where('status', 'approved')->avg('rating') ?: 0;

        return view('therapist.dashboard', compact('therapist', 'bookings', 'totalEarnings', 'totalClients', 'approvedReviewsCount', 'averageRating'));
    }

    public function bookings(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $query = TherapistBooking::where('therapist_id', $therapist->id);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        $bookings = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('therapist.bookings._table', compact('bookings'))->render();
        }

        return view('therapist.bookings.index', compact('bookings'));
    }

    public function profile()
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $services = \App\Models\Service::where('is_active', true)->get();
        $assignedServices = $therapist->services->mapWithKeys(function ($s) {
            return [
                $s->id => [
                    'fees' => $s->pivot->fees,
                    'duration' => $s->pivot->duration
                ]
            ];
        })->toArray();
        return view('therapist.profile', compact('therapist', 'services', 'assignedServices'));
    }
    public function updateProfile(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'fees' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'office_address' => 'nullable|string',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'service_fees' => 'nullable|array',
        ]);

        $data = $request->except(['image', 'services', 'service_fees', '_token', '_method']);

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not a default url
            if ($therapist->image && !Str::startsWith($therapist->image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($therapist->image);
            }
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        $therapist->update($data);

        if ($request->has('services')) {
            $syncData = [];
            foreach ($request->services as $serviceId) {
                $syncData[$serviceId] = [
                    'fees' => $request->service_fees[$serviceId] ?? null,
                    'duration' => $request->service_durations[$serviceId] ?? null
                ];
            }
            $therapist->services()->sync($syncData);
        } else {
            $therapist->services()->detach();
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function clients(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $query = TherapistBooking::where('therapist_id', $therapist->id);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $clients = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('therapist.clients._table', compact('clients'))->render();
        }

        return view('therapist.clients.index', compact('clients'));
    }
    public function reviews(Request $request)
    {
        $therapist = Team::where('email', Auth::user()->email)->first();
        $reviews = \App\Models\Review::where('team_id', $therapist->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('therapist.reviews', compact('reviews'));
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

        $data = [
            'availability_type' => $request->availability_type ?? 'date'
        ];

        // Process Date-wise Availability
        $formattedAvailability = [];
        if ($request->has('availability')) {
            foreach ($request->availability as $serviceId => $dates) {
                if (is_array($dates)) {
                    foreach ($dates as $date => $modes) {
                        // Initialize date entry to allow 'blocked' days (overrides)
                        if (!isset($formattedAvailability[$serviceId][$date])) {
                            $formattedAvailability[$serviceId][$date] = [];
                        }
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_filter(array_map('trim', explode(',', $times)));
                                    if (!empty($timeArray)) {
                                        $formattedAvailability[$serviceId][$date][$mode] = $timeArray;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $data['availability'] = $formattedAvailability;

        // Process Weekly Availability
        $formattedWeekly = [];
        if ($request->has('weekly_availability')) {
            foreach ($request->weekly_availability as $serviceId => $days) {
                if (is_array($days)) {
                    foreach ($days as $day => $modes) {
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_filter(array_map('trim', explode(',', $times)));
                                    if (!empty($timeArray)) {
                                        $formattedWeekly[$serviceId][$day][$mode] = $timeArray;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $data['weekly_availability'] = $formattedWeekly;

        // Process Addresses
        $data['weekly_addresses'] = $request->has('weekly_addresses') ? array_filter($request->weekly_addresses) : null;
        $data['date_addresses'] = $request->has('date_addresses') ? array_filter($request->date_addresses) : null;

        $therapist->update($data);

        return back()->with('success', 'Availability updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
