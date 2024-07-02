<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;

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
        ]);

        StorageFacility::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'contacts' => $request->input('contacts'),
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
        ]);

        $facility = StorageFacility::findOrFail($id);
        $facility->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Storage facility updated successfully.');
    }

    public function destroy($id)
    {
        $facility = StorageFacility::findOrFail($id);
        $facility->delete();

        return redirect()->route('dashboard')->with('success', 'Storage facility deleted successfully.');
    }
}



