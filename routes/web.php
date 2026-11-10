<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('otocare');
// });

Route::livewire('/app', 'app')
    ->name('app');

Route::livewire('/', 'landing-page')
    ->name('landing');
