<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $facilities = StorageFacility::all();
        return view('dashboard', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'contacts' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'slots_available' => 'required|integer',
            'image' => 'nullable|image|max:2048', // Validate image if present
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        StorageFacility::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'contacts' => $request->input('contacts'),
            'county' => $request->input('county'),
            'slots_available' => $request->input('slots_available'),
            'image' => $imagePath,
        ]);

        

        return redirect()->route('dashboard')->with('success', 'Storage facility added successfully!');
    }

    public function edit($id)
    {
        $facility = StorageFacility::findOrFail($id);
        return view('storage_facilities.info_edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'contacts' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'slots_available' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $facility = StorageFacility::findOrFail($id);
        $imagePath = $facility->image;

    if ($request->file('image')) {
        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
        $imagePath = $request->file('image')->store('images', 'public');
    }

    $facility->update([
        'name' => $request->input('name'),
        'location' => $request->input('location'),
        'description' => $request->input('description'),
        'contacts' => $request->input('contacts'),
        'county' => $request->input('county'),
        'slots_available' => $request->input('slots_available'),
        'image' => $imagePath,
    ]);
        

        return redirect('dashboard')->with('success', 'Storage facility updated successfully.');
    }

    public function destroy($id)
    {
        $facility = StorageFacility::findOrFail($id);
        $facility->delete();

        return redirect()->route('dashboard')->with('success', 'Storage facility deleted successfully.');
    }

    public function viewDashboard()
    {
        $facilities = StorageFacility::all();
        $bookings = Booking::with(['user', 'facility'])->get();
        return view('dashboard', compact('facilities', 'bookings'));
    }
}



