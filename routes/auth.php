<?php

use App\Http\Controllers\Auth\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
], function () {

    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })
        ->middleware('auth')
        ->name('logout');

    Route::get('/redirect', function () {
        return Socialite::driver('dribbble')->redirect();
    })
        ->middleware('guest')
        ->name('redirect');

    Route::get('/callback', [SocialiteAuthController::class, 'callback'])
        ->middleware('guest')
        ->name('callback');

});
