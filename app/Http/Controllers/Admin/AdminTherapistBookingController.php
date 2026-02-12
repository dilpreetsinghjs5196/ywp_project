<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TherapistBooking;
use Illuminate\Http\Request;

class AdminTherapistBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = TherapistBooking::with('therapist')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.therapist_bookings.index', compact('bookings'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = TherapistBooking::with('therapist')->findOrFail($id);
        return view('admin.therapist_bookings.show', compact('booking'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = TherapistBooking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.therapist-bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
