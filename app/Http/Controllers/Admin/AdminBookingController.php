<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('subject', 'like', '%' . $request->search . '%');
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.bookings._table', compact('bookings'))->render();
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->only('status'));
        return back()->with('success', 'Booking status updated.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted.');
    }
}
