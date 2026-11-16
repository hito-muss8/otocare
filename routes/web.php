
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::livewire('/account', 'pages.account')->name('account');
Route::livewire('/auth', 'pages.auth')->name('auth');
Route::livewire('/booking', 'pages.booking')
    ->middleware('auth')
    ->name('booking');
Route::livewire('/landing', 'pages.landing')->name('landing');
Route::livewire('/orders', 'pages.orders')->name('orders');
Route::livewire('/payment', 'pages.payment')->name('payment');

Route::livewire('/app', 'app')->name('app');
Route::livewire('/components', 'components')->name('components');
Route::livewire('/data', 'data')->name('data');
Route::livewire('/steps', 'steps')->name('steps');

// Admin Dashboard
Route::livewire('/admin/dashboard', 'pages.admin.dashboard')
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// Logout
Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');

})->middleware('auth')->name('logout');