<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:storage_facilities,id',
            'email' => 'required|email',
            'phone' => 'required|string',
            'slots' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'info' => 'required|string',
            'total_price' => 'required|numeric|min:0',
        ]);

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->facility_id = $request->facility_id;
        $booking->name = Auth::user()->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->slots = $request->slots;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->info = $request->info;
        $booking->total_price = $request->total_price;
        $booking->save();

        return redirect()->back()->with('success', 'Your booking request has been submitted.');
    }

    public function create(Request $request)
    {
        $facilityId = $request->input('facility_id');
        $facility = StorageFacility::findOrFail($facilityId);
    
        return view('booking', compact('facility'));
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



