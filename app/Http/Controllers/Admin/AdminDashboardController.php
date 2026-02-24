<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'therapists' => \App\Models\Team::count(),
            'services' => \App\Models\Service::count(),
            'bookings' => \App\Models\TherapistBooking::where('payment_status', 'paid')->count(),
            'revenue' => \App\Models\TherapistBooking::where('payment_status', 'paid')->sum('amount'),
            'orders' => \App\Models\Order::count(),
            'queries' => \App\Models\Appointment::count(),
            'blogs' => \App\Models\Blog::count(),
        ];

        $recentBookings = \App\Models\TherapistBooking::with('therapist')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentQueries = \App\Models\Appointment::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $genderStats = \App\Models\TherapistBooking::where('payment_status', 'paid')
            ->select('gender', \DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();

        $locationStats = \App\Models\TherapistBooking::where('payment_status', 'paid')
            ->select('location', \DB::raw('count(*) as total'))
            ->groupBy('location')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentQueries', 'genderStats', 'locationStats'));
    }
}
