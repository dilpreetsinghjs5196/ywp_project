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
    public function index(Request $request)
    {
        $query = TherapistBooking::with('therapist');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('therapist_id')) {
            $query->where('therapist_id', $request->therapist_id);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $therapists = \App\Models\Team::orderBy('name')->get();

        if ($request->ajax()) {
            return view('admin.therapist_bookings._table', compact('bookings'))->render();
        }

        return view('admin.therapist_bookings.index', compact('bookings', 'therapists'));
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

    public function exportCsv(Request $request)
    {
        $query = TherapistBooking::with('therapist');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('therapist_id')) {
            $query->where('therapist_id', $request->therapist_id);
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();

        $filename = "therapist_bookings_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // CSV Header
        fputcsv($handle, ['Booking ID', 'Patient Name', 'Gender', 'Location', 'Patient Email', 'Patient Phone', 'Therapist Name', 'Booking Date', 'Booking Time', 'Mode', 'Amount', 'Status', 'Booking Created At']);

        foreach ($bookings as $booking) {
            fputcsv($handle, [
                $booking->id,
                $booking->name,
                $booking->gender,
                $booking->location,
                $booking->email,
                $booking->phone,
                $booking->therapist ? $booking->therapist->name : 'N/A',
                $booking->booking_date,
                $booking->booking_time,
                $booking->mode,
                $booking->amount,
                strtoupper($booking->payment_status),
                $booking->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($handle);
        exit;
    }
}
