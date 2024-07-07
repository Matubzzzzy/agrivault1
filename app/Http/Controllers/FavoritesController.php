<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageFacility;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('facility')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:storage_facilities,id',
        ]);

        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->facility_id = $request->facility_id;
        $favorite->save();

        return redirect('home')->with('success', 'Added to favorites successfully!');
    }

    public function removeFromFavorites($facility)
{
    // Logic to remove from favorites
    // Example: Favorite::where('user_id', auth()->id())->where('facility_id', $facility)->delete();
    Favorite::where('user_id', auth()->id())->where('facility_id', $facility)->delete();
    
    return redirect()->route('favorites')->with('success', 'Removed from favorites successfully!');
}
}
