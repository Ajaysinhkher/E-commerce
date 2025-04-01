<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// General Public Routes
Route::get("/", [HomepageController::class, "index"])->name("home");
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product-details/{id}', [ShopController::class, 'show'])->name('product.details');

// Guest User Routes
Route::middleware("guest:customer")->group(function () {
    Route::get("/login", [LoginController::class, "index"])->name("customer.login");
    Route::post("/login", [LoginController::class, "authenticate"])->name("customer.authenticate");

    // Register route for customers/guest users
    Route::get("/register", [RegisterController::class, "index"])->name("register");
    Route::post("/register", [RegisterController::class, "register"]);
});

// Authenticated Customer Routes
Route::middleware("auth:customer")->group(function () {
    Route::post("logout", [LoginController::class, "logout"])->name("customer.logout");
});



// Cart Routes

Route::prefix('cart')->group(function(){

    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    
    Route::middleware("auth:customer")->group(function () {
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
        Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    });
});


// checkout routes:
Route::middleware("auth:customer")->group(function(){
    Route::get('/checkout',[OrderController::class,'index'])->name('checkout.index');
    Route::post('/placeorder',[OrderController::class,'placeOrder'])->name('place.order');
    Route::get('/orderplaced/{id}',[OrderController::class,'orderPlaced'])->name('order.success');
});

Route::get('/search', [HomepageController::class, 'search'])->name('search');
Route::get('/contact',[HomepageController::class,'contact'])->name('contact');
Route::post('/contact/submit', [HomepageController::class, 'submitContactForm'])->name('contact.submit');
