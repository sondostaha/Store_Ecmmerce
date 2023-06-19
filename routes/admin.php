<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\TagsController;
use App\Http\Controllers\AdminDashboard\ProfileControll;
use App\Http\Controllers\AdminDashboard\BrandsController;
use App\Http\Controllers\AdminDashboard\SettingController;
use App\Http\Controllers\AdminDashboard\DashboardController;
use App\Http\Controllers\AdminDashboard\SubCategoryController;
use App\Http\Controllers\AdminDashboard\MainCategoriesController;

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
    Route::get('/',[DashboardController::class ,'index'] )->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

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

    //categories
    Route::prefix('mainCategories')->group(function(){
        
        Route::get('/',[MainCategoriesController::class ,'index'])->name('admin.categories');
        Route::get('add',[MainCategoriesController::class ,'create'])->name('admin.create.categories');
        Route::post('store',[MainCategoriesController::class ,'store'])->name('admin.store.categories');
        Route::get('edit/{id}',[MainCategoriesController::class ,'edit'])->name('admin.edit.categories');
        Route::post('update/{id}',[MainCategoriesController::class ,'update'])->name('admin.update.categories');
        Route::get('delete/{id}',[MainCategoriesController::class ,'delete'])->name('admin.delete.categories');

    });

    //sub categories
    Route::prefix('subcategories')->group(function(){
        
        Route::get('/',[SubCategoryController::class ,'index'])->name('admin.subcategories');
        Route::get('add',[SubCategoryController::class ,'create'])->name('admin.create.subcategories');
        Route::post('store',[SubCategoryController::class ,'store'])->name('admin.store.subcategories');
        Route::get('edit/{id}',[SubCategoryController::class ,'edit'])->name('admin.edit.subcategories');
        Route::post('update/{id}',[SubCategoryController::class ,'update'])->name('admin.update.subcategories');
        Route::get('delete/{id}',[SubCategoryController::class ,'delete'])->name('admin.delete.subcategories');

    });

     // brands
     Route::prefix('brands')->group(function(){
        
        Route::get('/',[BrandsController::class ,'index'])->name('admin.brands');
        Route::get('add',[BrandsController::class ,'create'])->name('admin.create.brands');
        Route::post('store',[BrandsController::class ,'store'])->name('admin.store.brands');
        Route::get('edit/{id}',[BrandsController::class ,'edit'])->name('admin.edit.brands');
        Route::post('update/{id}',[BrandsController::class ,'update'])->name('admin.update.brands');
        Route::get('delete/{id}',[BrandsController::class ,'delete'])->name('admin.delete.brands');

    });

     // brands
     Route::prefix('tags')->group(function(){
        
        Route::get('/',[TagsController::class ,'index'])->name('admin.tags');
        Route::get('add',[TagsController::class ,'create'])->name('admin.create.tags');
        Route::post('store',[TagsController::class ,'store'])->name('admin.store.tags');
        Route::get('edit/{id}',[TagsController::class ,'edit'])->name('admin.edit.tags');
        Route::post('update/{id}',[TagsController::class ,'update'])->name('admin.update.tags');
        Route::get('delete/{id}',[TagsController::class ,'delete'])->name('admin.delete.tags');

    });

   
});

require __DIR__.'/admin_auth.php';
