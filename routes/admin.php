<?php

use App\Http\Controllers\AdminDashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('admin.auth.login');
});

Route::get('/',[DashboardController::class ,'index'] )->middleware(['auth:admin', 'verified'])->name('dashboard');

require __DIR__.'/admin_auth.php';
