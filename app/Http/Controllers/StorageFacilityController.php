<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;

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
        ]);

        StorageFacility::create($request->all());

        return redirect()->route('storage-facilities.index')->with('success', 'Storage facility added successfully.');
    }

    public function edit($id)
    {
        $facility = StorageFacility::findOrFail($id);
        return view('storage_facilities.edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'contacts' => 'required|string|max:255',
        ]);

        $facility = StorageFacility::findOrFail($id);
        $facility->update($request->all());

        return redirect()->route('storage-facilities.index')->with('success', 'Storage facility updated successfully.');
    }

    public function destroy($id)
    {
        $facility = StorageFacility::findOrFail($id);
        $facility->delete();

        return redirect()->route('storage-facilities.index')->with('success', 'Storage facility deleted successfully.');
    }
}
