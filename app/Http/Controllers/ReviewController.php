<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        // Validate the request data
        $request->validate([
            'facility_id' => 'required|exists:storage_facilities,id',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:255',
        ]);

        // Save the review
        $review = new Review();
        $review->user_id = auth()->id();
        $review->facility_id = $request->facility_id;
        $review->rating = $request->rating;
        $review->review_text = $request->review;
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}
