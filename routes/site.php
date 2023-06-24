<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\site\VerificationCodeController;
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

Route::get('/home',[HomeController::class ,'index'])->middleware(['auth', 'verifiyCode'])->name('home');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/verify',[VerificationCodeController::class , 'verifyPage']);
    Route::post('vrefiy/user',[VerificationCodeController::class ,'verify'])->name('verify.user');
});

require __DIR__.'/auth.php';
