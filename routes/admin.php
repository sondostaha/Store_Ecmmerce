<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\OptionControl;
use App\Http\Controllers\AdminDashboard\TagsController;
use App\Http\Controllers\AdminDashboard\ProfileControll;
use App\Http\Controllers\AdminDashboard\RolesController;
use App\Http\Controllers\AdminDashboard\BrandsController;
use App\Http\Controllers\AdminDashboard\SliderController;
use App\Http\Controllers\AdminDashboard\ProductController;
use App\Http\Controllers\AdminDashboard\SettingController;
use App\Http\Controllers\AdminDashboard\AttributeController;
use App\Http\Controllers\AdminDashboard\DashboardController;
use App\Http\Controllers\AdminDashboard\SubCategoryController;
use App\Http\Controllers\AdminDashboard\MainCategoriesController;
use App\Http\Controllers\AdminDashboard\UserController;

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

    ####################################### setting  ####################################################

    Route::prefix('setting')->group(function(){
        //shipping
        Route::get('shipping/{type}',[SettingController::class ,'shipping'])->name('edit.shipping');
        //update shipping
        Route::post('update/shaping/{id}' ,[SettingController::class , 'shippingUpdate'])->name('update.shipping');

    });

    ####################################### categories ####################################################

    Route::prefix('mainCategories')->group(function(){
        
        Route::get('/',[MainCategoriesController::class ,'index'])->name('admin.categories');
        Route::get('add',[MainCategoriesController::class ,'create'])->name('admin.create.categories');
        Route::post('store',[MainCategoriesController::class ,'store'])->name('admin.store.categories');
        Route::get('edit/{id}',[MainCategoriesController::class ,'edit'])->name('admin.edit.categories');
        Route::post('update/{id}',[MainCategoriesController::class ,'update'])->name('admin.update.categories');
        Route::get('delete/{id}',[MainCategoriesController::class ,'delete'])->name('admin.delete.categories');

    });


    ####################################### brands ####################################################

     Route::prefix('brands')->group(function(){
        
        Route::get('/',[BrandsController::class ,'index'])->name('admin.brands');
        Route::get('add',[BrandsController::class ,'create'])->name('admin.create.brands');
        Route::post('store',[BrandsController::class ,'store'])->name('admin.store.brands');
        Route::get('edit/{id}',[BrandsController::class ,'edit'])->name('admin.edit.brands');
        Route::post('update/{id}',[BrandsController::class ,'update'])->name('admin.update.brands');
        Route::get('delete/{id}',[BrandsController::class ,'delete'])->name('admin.delete.brands');

    });

    ####################################### tags ####################################################


     Route::prefix('tags')->group(function(){
        
        Route::get('/',[TagsController::class ,'index'])->name('admin.tags');
        Route::get('add',[TagsController::class ,'create'])->name('admin.create.tags');
        Route::post('store',[TagsController::class ,'store'])->name('admin.store.tags');
        Route::get('edit/{id}',[TagsController::class ,'edit'])->name('admin.edit.tags');
        Route::post('update/{id}',[TagsController::class ,'update'])->name('admin.update.tags');
        Route::get('delete/{id}',[TagsController::class ,'delete'])->name('admin.delete.tags');

    });

    ####################################### products ####################################################

       Route::group(['prefix' => 'Products','middleware'=> 'can:product'],function(){
        
        Route::get('/',[ProductController::class ,'index'])->name('admin.general.products');
        Route::get('add',[ProductController::class ,'create'])->name('admin.create.general.products');
        Route::post('store',[ProductController::class ,'store'])->name('admin.store.general.products');

        Route::get('price/{id}',[ProductController::class ,'getPrice'])->name('admin.price.create.products');
        Route::post('store/price',[ProductController::class ,'storeprice'])->name('admin.store.price.products');

        Route::get('stock/{id}',[ProductController::class ,'getStock'])->name('admin.stock.create.products');
        Route::post('store/stock',[ProductController::class ,'storestock'])->name('admin.store.stock.products');

        Route::get('images/{id}',[ProductController::class ,'getImages'])->name('admin.image.create.products');
        Route::post('store/image',[ProductController::class ,'storeImage'])->name('admin.store.image.products');
        Route::post('save/image',[ProductController::class ,'saveImage'])->name('admin.save.image.products');


        Route::get('delete/{id}',[ProductController::class ,'delete'])->name('admin.delete.general.products');

            ####################################### attributes ####################################################

        Route::prefix('attributes')->group(function(){
            
            Route::get('/',[AttributeController::class ,'index'])->name('admin.attribute');
            Route::get('add',[AttributeController::class ,'create'])->name('admin.create.attribute');
            Route::post('store',[AttributeController::class ,'store'])->name('admin.store.attribute');
            Route::get('edit/{id}',[AttributeController::class ,'edit'])->name('admin.edit.attribute');
            Route::post('update/{id}',[AttributeController::class ,'update'])->name('admin.update.attribute');
            Route::get('delete/{id}',[AttributeController::class ,'delete'])->name('admin.delete.attribute');

        });

            ####################################### attributes ####################################################

        Route::prefix('options')->group(function(){
            
            Route::get('/',[OptionControl::class ,'index'])->name('admin.options');
            Route::get('add',[OptionControl::class ,'create'])->name('admin.create.options');
            Route::post('store',[OptionControl::class ,'store'])->name('admin.store.options');
            Route::get('edit/{id}',[OptionControl::class ,'edit'])->name('admin.edit.options');
            Route::post('update/{id}',[OptionControl::class ,'update'])->name('admin.update.options');
            Route::get('delete/{id}',[OptionControl::class ,'delete'])->name('admin.delete.options');

        });

    });


    ####################################### SLIDER ####################################################

    Route::prefix('slider')->group(function(){
        
        Route::get('/add',[SliderController::class ,'addImage'])->name('admin.create.slider');
        Route::post('images',[SliderController::class ,'saveSliderImages'])->name('admin.store.slider');
        Route::post('Image/db',[SliderController::class ,'saveSliderImagesDb'])->name('admin.store.db.slider');

    });
    ####################################### Roles ####################################################

    Route::group(['prefix' => 'roles' , ],function(){
        Route::get('/', [RolesController::class ,'index'] )->name('admin.roles');
        Route::get('add', [RolesController::class ,'create'] )->name('admin.roles.create');
        Route::post('store', [RolesController::class ,'store'] )->name('admin.roles.store');
        Route::get('edit/{id}', [RolesController::class ,'edit'] )->name('admin.roles.edit');
        Route::post('update/{id}', [RolesController::class ,'update'] )->name('admin.roles.update');
        Route::get('delete/{id}', [RolesController::class ,'delete'] )->name('admin.roles.delete');
    });

        ####################################### Roles ####################################################

        Route::group(['prefix' => 'user'],function(){
            Route::get('/', [UserController::class ,'index'] )->name('admin.user');
            Route::get('add', [UserController::class ,'create'] )->name('admin.user.create');
            Route::post('store', [UserController::class ,'store'] )->name('admin.user.store');
            Route::get('edit/{id}', [UserController::class ,'edit'] )->name('admin.user.edit');
            Route::post('update/{id}', [UserController::class ,'update'] )->name('admin.user.update');
            Route::get('delete/{id}', [UserController::class ,'delete'] )->name('admin.user.delete');
        });


});

require __DIR__.'/admin_auth.php';
