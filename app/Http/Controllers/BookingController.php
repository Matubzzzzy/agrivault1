<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Auth;

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
        $booking->save();

        return redirect()->back()->with('success', 'Your booking request has been submitted.');
    }

    public function create(Request $request)
    {
        $facilityId = $request->input('facility_id');
        $facility = StorageFacility::findOrFail($facilityId);
    
        return view('booking', compact('facility'));
    }
}



