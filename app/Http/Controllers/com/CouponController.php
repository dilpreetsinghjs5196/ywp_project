<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CouponApprovedMail;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Show the form to request a coupon code.
     */
    public function requestForm()
    {
        return view('site.com.coupon_request');
    }

    /**
     * Submit the coupon request.
     */
    public function submitRequest(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
        ]);

        // Generate a random unique coupon code
        $code = strtoupper(Str::random(8));
        while (Coupon::where('code', $code)->exists()) {
            $code = strtoupper(Str::random(8));
        }

        Coupon::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'code' => $code,
            'discount_amount' => 500, // Default discount, can be made dynamic
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your coupon request has been submitted! Please wait for admin approval. Your code is: ' . $code);
    }

    /**
     * Admin: List all coupons.
     */
    public function adminIndex()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Admin: Approve a coupon.
     */
    public function approve($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['status' => 'approved']);

        // Send Email
        try {
            Mail::to($coupon->user_email)->send(new CouponApprovedMail($coupon));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Coupon Approval Email Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Coupon approved and email sent to ' . $coupon->user_email);
    }

    /**
     * Admin: Reject a coupon.
     */
    public function reject($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Coupon rejected.');
    }

    /**
     * Admin: Update a coupon.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'code' => 'required|string|max:100',
            'discount_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected,used',
        ]);

        $coupon = Coupon::findOrFail($id);
        
        $oldStatus = $coupon->status;
        $newStatus = $request->status;

        $coupon->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'code' => strtoupper($request->code),
            'discount_amount' => $request->discount_amount,
            'status' => $request->status,
        ]);

        // If status was changed to approved, send the email automatically
        if ($oldStatus !== 'approved' && $newStatus === 'approved') {
            try {
                Mail::to($coupon->user_email)->send(new CouponApprovedMail($coupon));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Coupon Approval Email Error on Update: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Coupon successfully updated.');
    }

    /**
     * Check coupon code validity.
     */
    public function checkCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'email' => 'nullable|email',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code. Please try again.',
            ]);
        }

        // Secure: Double check that if the coupon is linked to a user email, the requested email matches (case-insensitive)
        if ($coupon->user_email && $request->filled('email') && strtolower($coupon->user_email) !== strtolower($request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not registered for your email address.',
            ]);
        }

        if ($coupon->status === 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is currently pending approval.',
            ]);
        }

        if ($coupon->status === 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'This coupon code has been rejected by the admin.',
            ]);
        }

        if ($coupon->status === 'used') {
            return response()->json([
                'success' => false,
                'message' => 'This coupon code has already been used.',
            ]);
        }

        if ($coupon->status === 'approved') {
            return response()->json([
                'success' => true,
                'discount_amount' => (float)$coupon->discount_amount,
                'message' => 'Coupon code successfully applied!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid coupon status.',
        ]);
    }
}
