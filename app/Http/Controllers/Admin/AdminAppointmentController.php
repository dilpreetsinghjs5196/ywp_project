<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Appointment::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('subject', 'like', '%' . $request->search . '%');
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.appointments._table', compact('appointments'))->render();
        }

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->only('status'));

        return back()->with('success', 'Appointment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment record deleted successfully.');
    }
}
