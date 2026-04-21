<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'is_anonymous' => 'sometimes|boolean'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_anonymous'] = $request->has('is_anonymous');
        $validated['status'] = 'pending';

        Review::create($validated);

        return back()->with('success', 'Your review has been submitted and is awaiting approval.');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'is_anonymous' => 'sometimes|boolean'
        ]);

        $validated['is_anonymous'] = $request->has('is_anonymous');
        // Reset status to pending for re-approval
        $validated['status'] = 'pending';

        $review->update($validated);

        return back()->with('success', 'Your review has been updated and is awaiting re-approval.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
