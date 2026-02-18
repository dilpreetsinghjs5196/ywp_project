<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with('team')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('comment', 'like', "%$search%")
                    ->orWhereHas('team', function ($t) use ($search) {
                        $t->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $reviews = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.reviews._table', compact('reviews'))->render();
        }

        return view('admin.reviews.index', compact('reviews'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $review->update(['status' => $request->status]);

        return back()->with('success', 'Review status updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
