<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $facilities = StorageFacility::all(); // Adjust as per your query needs
        $locations = StorageFacility::distinct('county')->pluck('county'); // Get distinct counties for dropdown

    return view('home', compact('facilities', 'locations')); // Assuming 'home' is the user homepage view
    }
}
