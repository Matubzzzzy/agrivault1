<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

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
        'facility_id' => 'required|exists:storage_facilities,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string',
    ]);

    Review::create([
        'facility_id' => $request->facility_id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully.');
}
}
