<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\StorageFacility;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $locations = StorageFacility::distinct('county')->pluck('county'); // Example: replace with your actual query
        $facilities = StorageFacility::take(4)->get(); // Example: replace with your actual query

        return view('welcome', [
            'locations' => $locations,
            'facilities' => $facilities,
        ]);
    }
}
