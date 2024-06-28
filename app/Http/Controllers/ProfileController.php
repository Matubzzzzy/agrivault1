<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // public function show()
    // {
    //     $user = Auth::user();
    //     return view('profile.show', compact('user'));
    // }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->input('password')) {
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);

            $user->password = bcrypt($request->input('password'));
        }
        
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Store the new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures');

            // Update the user's profile picture path in the database
            $user->profile_picture = $path;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');

    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            
            $user->delete();

            return redirect('/')->with('status', 'profile-deleted');
        }

        return back()->withErrors(['password' => 'The provided password does not match our records.']);
    }
}
