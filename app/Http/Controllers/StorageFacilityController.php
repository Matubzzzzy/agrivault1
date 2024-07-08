<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Storage;

class StorageFacilityController extends Controller
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
            'slots_available' => 'required|integer|min:1',
            'total_slots' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('storage_images', 'public');
        }
        

        StorageFacility::create($request->all());

        return redirect()->route('storage-facilities.index')->with('success', 'Storage facility added successfully.');
    }

    public function edit($id)
    {
        $facility = StorageFacility::findOrFail($id);
        return view('storage_facilities.edit', compact('facility'));
    }

    public function update(Request $request, StorageFacility $facility)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'contacts' => 'required|string|max:255',
        'county' => 'required|string|max:255',
        'slots_available' => 'required|integer',
        'total_slots' => 'required|integer', // Ensure total_slots is validated
        'image' => 'nullable|image|max:2048',
    ]);

    // Debugging: Check if total_slots is present in the request
    dd($request->all());

    $facility->name = $request->name;
    $facility->location = $request->location;
    $facility->description = $request->description;
    $facility->contacts = $request->contacts;
    $facility->county = $request->county;
    $facility->slots_available = $request->slots_available;
    $facility->total_slots = $request->total_slots; // Assign total_slots

    // Debugging: Check if total_slots is being assigned correctly
    dd($facility);

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }
        // Store the new image
        $facility->image = $request->file('image')->store('facility_images', 'public');
    }

    $facility->save();

    return redirect()->back()->with('success', 'Facility updated successfully!');
}

    public function destroy($id)
    {
        $facility = StorageFacility::findOrFail($id);
        $facility->delete();

        return redirect()->route('storage-facilities.index')->with('success', 'Storage facility deleted successfully.');
    }
}
