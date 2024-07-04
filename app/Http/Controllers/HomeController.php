<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $facilities = StorageFacility::all(); // Adjust as per your query needs
        $locations = StorageFacility::distinct('county')->pluck('county'); // Get distinct counties for dropdown

    return view('home', compact('facilities', 'locations')); // Assuming 'home' is the user homepage view
    
    }
}
