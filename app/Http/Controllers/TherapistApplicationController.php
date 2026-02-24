<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TherapistJoinRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;

class TherapistApplicationController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'experience' => 'required|string',
            'message' => 'nullable|string',
        ]);

        $recipientEmail = SiteSetting::where('key', 'therapist_application_email')->first()->value ?? SiteSetting::where('key', 'workplace_email')->first()->value ?? 'dilpreetsingh5196@gmail.com';

        try {
            Mail::to($recipientEmail)->send(new TherapistJoinRequest($request->all()));
            return response()->json(['success' => true, 'message' => 'Your application has been submitted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send application: ' . $e->getMessage()], 500);
        }
    }
}
