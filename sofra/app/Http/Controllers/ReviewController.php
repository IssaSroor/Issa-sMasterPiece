<?php

namespace App\Http\Controllers;

use App\Models\Kitchen_review;
use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function index(Request $request)
    {
        // dd($kitchen);
        $kitchens = Kitchen::whereHas('reviews', function ($query) {
            $query->where('review_status', 'pending');
        })->get();
        // If a kitchen is selected, fetch reviews for that kitchen
        $reviews = null;
        $selectedKitchen = null;

        if ($request->has('kitchen_id')) {
            $selectedKitchen = Kitchen::find($request->input('kitchen_id'));
            $reviews = Kitchen_review::with('user')
                ->where('kitchen_id', $selectedKitchen->id)
                ->where('review_status','pending')
                ->get();
        }

        return view('admin.reviews.index', [
            'kitchens' => $kitchens,
            'reviews' => $reviews,
            'selectedKitchen' => $selectedKitchen,
        ]);
    }

    public function approve($review)
    {
        // dd($review);
        $review = Kitchen_review::findOrFail($review);
        $review->update([
            'review_status' => 'approved',
            'accepted_by' => Auth::id() // Record the admin who approved the review
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review approved successfully!');
    }

    // Reject a review
    public function reject($review)
    {
        $review = Kitchen_review::findOrFail($review);
        $review->update([
            'review_status' => 'rejected',
            'accepted_by' => Auth::id()
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review rejected successfully!');
    }
}
