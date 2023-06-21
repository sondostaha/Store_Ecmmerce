<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | site Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register site routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "site" middleware group. Make something great!
// |
// */

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('front.home');
})->middleware(['auth', 'verified'])->name('home');

require __DIR__.'/auth.php';
