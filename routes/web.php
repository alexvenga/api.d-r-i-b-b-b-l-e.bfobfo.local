<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/file/{file}', function (\App\Models\File $file) {
    return view('file.item', compact('file'));
})->name('file.item');

Route::get('/download/{file}', function (\App\Models\File $file) {
    dump($file);;
})
    ->middleware(['auth','isFollow'])
    ->name('file.download');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
