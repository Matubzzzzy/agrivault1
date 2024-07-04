<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function show($id)
    {
        $facility = StorageFacility::findOrFail($id);
        return view('booking', compact('facility'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'facility_id' => 'required|exists:storage_facilities,id',
            'email' => 'required|email',
            'phone' => 'required',
            'slots' => 'required|integer|min:1',
            'info' => 'required',
        ]);

        $facility = StorageFacility::findOrFail($validatedData['facility_id']);
        $user = Auth::user();

        if ($facility->slots_available < $validatedData['slots']) {
            return redirect()->back()->with('error', 'Not enough available slots.');
        }

        Booking::create([
            'facility_id' => $validatedData['facility_id'],
            'user_id' => $user->id,
            'username' => $user->name,
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'slots' => $validatedData['slots'],
            'info' => $validatedData['info'],
        ]);

        // Update available slots
        $facility->slots_available -= $validatedData['slots'];
        $facility->save();

        return redirect('home')->with('success', 'Booking request submitted successfully.');
    }
}


