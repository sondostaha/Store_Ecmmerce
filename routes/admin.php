<?php

use App\Http\Controllers\AdminDashboard\DashboardController;
use App\Http\Controllers\AdminDashboard\SettingController;
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

Route::group(['middleware'=> 'auth:admin'], function(){
    Route::get('/',[DashboardController::class ,'index'] )->middleware(['auth:admin', 'verified'])->name('dashboard');

    //setting shipping
    Route::get('shipping/{type}',[SettingController::class ,'shipping'])->name('edit.shipping');
    //update shipping
    Route::post('update/shaping/{id}' ,[SettingController::class , 'shippingUpdate'])->name('update.shipping');
});

require __DIR__.'/admin_auth.php';
