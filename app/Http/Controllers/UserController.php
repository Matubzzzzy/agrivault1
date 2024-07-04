<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $facilities = StorageFacility::all(); // Adjust as per your query needs
        $locations = StorageFacility::distinct('county')->pluck('county'); // Get distinct counties for dropdown

    return view('home', compact('facilities', 'locations')); // Assuming 'home' is the user homepage view
    }

    public function bookingHistory()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->with('facility')->get();

        return view('booking_history', compact('bookings'));
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min=1|max=5',
            'review' => 'required|string',
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->review_rating = $request->rating;
        $booking->review_text = $request->review;
        $booking->save();

        return redirect()->route('user.booking.history')->with('success', 'Review submitted successfully.');
    }
}
