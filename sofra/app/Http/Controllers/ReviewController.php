<?php

namespace App\Http\Controllers;

use App\Models\Kitchen_review;
use App\Models\Kitchen;
use App\Models\Order;
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
                ->where('review_status', 'pending')
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

    public function checkPurchased(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'You need to log in before adding a review.',
            ]);
        }

        $kitchenId = $request->kitchen_id;

        $hasPurchased = Order::where('customer_id', $user->id)
            ->whereHas('items', function ($query) use ($kitchenId) {
                $query->where('kitchen_id', $kitchenId);
            })
            ->exists();

        if ($hasPurchased) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot add a review for this kitchen without purchasing first.',
            ]);
        }
    }



    // Store the review
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'kitchen_id' => 'required|exists:kitchens,id',
            'review_text' => 'required|string|max:1000',
            'review_rating' => 'required|integer|min:1|max:5',
        ]);
    
        $user = Auth::user();
    
        // Save the review
        Kitchen_review::create([
            'customer_id' => $user->id,
            'kitchen_id' => $validated['kitchen_id'],
            'review_text' => $validated['review_text'],
            'review_rating' => $validated['review_rating'],
            'accepted_by' => 0,
        ]);
    
        // Calculate the new average review rating for the kitchen
        $averageRating = Kitchen_review::where('kitchen_id', $validated['kitchen_id'])
            ->avg('review_rating');
    
        // Update the kitchens table with the new average rating
        Kitchen::where('id', $validated['kitchen_id'])->update([
            'kitchen_rating' => $averageRating,
        ]);
    
        return redirect()->back()->with('success', 'Your review has been submitted successfully.');
    }
    

}
