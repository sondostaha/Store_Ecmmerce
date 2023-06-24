<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\site\VerificationCodeController;
use App\Http\Controllers\Site\WishlistController;
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
Route::group(['middleware' => [ 'auth', 'verifiyCode' ]],function(){
    Route::get('/home',[HomeController::class ,'index'])->name('home');
    //categories 
    Route::get('categories,{slug}',[CategoryController::class ,'productBySlug'])->name('category');

    Route::group(['prefix' => 'wishlist'],function(){
        //wishlist
        Route::post('/',[WishlistController::class ,'store'])->name('wishlist.store');
        Route::Delete('delete',[WishlistController::class ,'delete'])->name('wishlist.delete');
        Route::get('/products', [WishlistController::class ,'index'])->name('wishlist.products.index');

    });
    
    Route::group(['prefix' => 'cart'],function(){

        Route::get('/products', [CartController::class ,'getIndex'])->name('site.cart.index');
        Route::post('add/{slug?}',[CartController::class ,'postAdd'])->name('site.cart.add');

        Route::post('/update/{slug}', [CartController::class ,'postUpdate'])->name('site.cart.update');
        Route::post('/update_all', [CartController::class ,'postupdateAll'])->name('site.cart.update_all');

        Route::get('payment/{amount}', [PaymentController::class ,'getPayments'])->name('payments');
        Route::post('payment' ,[PaymentController::class ,'processPayment'])->name('payment.process');
    }); 

});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/verify',[VerificationCodeController::class , 'verifyPage']);
    Route::post('vrefiy/user',[VerificationCodeController::class ,'verify'])->name('verify.user');
});

require __DIR__.'/auth.php';
