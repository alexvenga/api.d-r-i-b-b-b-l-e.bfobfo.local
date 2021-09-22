<?php

use App\Http\Controllers\Auth\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->back();
})
    ->middleware('auth')
    ->name('logout');

Route::get('/login', function () {
    return Socialite::driver('dribbble')->redirect();
})
    ->middleware('guest')
    ->name('login');

Route::get('/auth/callback', [SocialiteAuthController::class, 'callback'])
    ->middleware('guest')
    ->name('callback');
