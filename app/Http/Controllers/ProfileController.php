<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

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
        ]);

        if ($request->input('password')) {
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);

            $user->password = bcrypt($request->input('password'));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile.show')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            $user->delete();

            return redirect('/')->with('status', 'profile-deleted');
        }

        return back()->withErrors(['password' => 'The provided password does not match our records.']);
    }
}
