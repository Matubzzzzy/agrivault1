<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StorageFacilityController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $request->fulfill();

    // Check if the user is authenticated
    if (Auth::check()) {
        // Redirect authenticated users to the dashboard
        return Redirect::intended('/dashboard');
    } else {
        // If user is not authenticated, redirect to login page
        return Redirect::to(URL::route('login'));
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'nocache'])->group(function () {
    // Protected routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Add other routes that should be protected and not cached
});

// Admin routes
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// User routes
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('user.home');
});

// Default home route (for authenticated users without a specific role)
// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Route::get('/reset-password/{token}', function (Illuminate\Http\Request $request, $token) {
//     return view('auth.passwords.reset', ['request' => $request, 'token' => $token]);
// })->name('password.reset');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');


Route::get('/', function () {
    return view('welcome'); // Ensure you have a 'welcome.blade.php' in 'resources/views'
})->name('welcome');

// Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'prevent-back-history'], function() {
    // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'ProfileController@show')->name('profile.edit');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
});

Route::middleware(['prevent-back-history'])->group(function () {
    Route::get('/profile', 'ProfileController@show');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::post('/storage-facilities', [AdminController::class, 'store'])->name('storage-facilities.store');
Route::get('/storage-facilities/{id}/info_edit', [AdminController::class, 'edit'])->name('storage-facilities.edit');
Route::put('/storage-facilities/{id}', [AdminController::class, 'update'])->name('storage-facilities.update');
Route::delete('/storage-facilities/{id}', [AdminController::class, 'destroy'])->name('storage-facilities.destroy');


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');
