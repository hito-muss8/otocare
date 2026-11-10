<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('otocare');
// });

// dalam pages
Route::livewire('/account', 'pages.account')
    ->name('account');

Route::livewire('/auth', 'pages.auth')
    ->name('auth');

Route::livewire('/booking', 'pages.booking')
    ->name('booking');

Route::livewire('/', 'pages.landing')
    ->name('landing');

Route::livewire('/orders', 'pages.orders')
    ->name('orders');

Route::livewire('/payment', 'pages.payment')
    ->name('payment');

// component
Route::livewire('/app', 'app')
    ->name('app');

Route::livewire('/components', 'components')
    ->name('components');

Route::livewire('/data', 'data')
    ->name('data');

Route::livewire('/steps', 'steps')
    ->name('steps');
