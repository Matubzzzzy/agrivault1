<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\StorageFacility;

class BookingController extends Controller
{
    public function show($id)
    {
        $facility = StorageFacility::findOrFail($id);
        return view('booking', compact('facility'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:storage_facilities,id',
            'email' => 'required|email',
            'phone' => 'required',
            'slots' => 'required|integer|min:1',
            'info' => 'required',
        ]);

        $facility = StorageFacility::findOrFail($request->facility_id);

        if ($facility->available_slots < $request->slots) {
            return redirect()->back()->with('error', 'Not enough available slots.');
        }

        // Store the booking request
        Booking::create([
            'facility_id' => $request->facility_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'slots' => $request->slots,
            'info' => $request->info,
        ]);

        // Update available slots
        $facility->available_slots -= $request->slots;
        $facility->save();

        return redirect()->route('booking.show', $facility->id)->with('success', 'Booking request submitted successfully.');
    }
}
