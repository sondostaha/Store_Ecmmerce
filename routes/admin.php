<?php

use App\Http\Controllers\AdminDashboard\DashboardController;
use App\Http\Controllers\AdminDashboard\ProfileControll;
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

    Route::prefix('profile')->group(function(){

        Route::get('edit',[ProfileControll::class,'edit'])->name('edit.profile');
        Route::post('update',[ProfileControll::class ,'update'])->name('update.profile');

    });
    //setting 
    Route::prefix('setting')->group(function(){
        //shipping
        Route::get('shipping/{type}',[SettingController::class ,'shipping'])->name('edit.shipping');
        //update shipping
        Route::post('update/shaping/{id}' ,[SettingController::class , 'shippingUpdate'])->name('update.shipping');

    });


   
});

require __DIR__.'/admin_auth.php';
