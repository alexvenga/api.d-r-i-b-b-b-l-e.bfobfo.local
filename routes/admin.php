<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth', 'isAdmin'],
], function () {


    Route::get('/users', \App\Http\Livewire\Admin\EditUsersComponent::class)
        ->name('users');

    Route::get('/files', \App\Http\Livewire\Admin\EditFilesComponent::class)
        ->name('files');

    /*
    Route::get('/languages', \App\Http\Livewire\Admin\EditLanguagesComponent::class)
        ->middleware('permission:languages')
        ->name('languages');

    Route::get('/roles', \App\Http\Livewire\Admin\EditRolesComponent::class)
        ->middleware('permission:roles')
        ->name('roles');

    Route::get('/titles', \App\Http\Livewire\Admin\EditTitlesComponent::class)
        ->middleware('permission:titles')
        ->name('titles');



    Route::group([
        'prefix' => 'courses',
        'as'     => 'courses.',
    ], function () {

        Route::get('/sections', \App\Http\Livewire\Admin\Courses\EditSectionsComponent::class)
            ->middleware('permission:users')
            ->name('sections');

    });
    */


});

