<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\CartController;

Route::prefix("admin")->group(function () {

// Admin guest (only for non-logged-in admins)
Route::middleware("guest:admin")->group(function () {
    Route::get("login", [AdminLoginController::class, "index"])->name("admin.login");
    Route::post("login", [AdminLoginController::class, "authenticate"])->name("admin.authenticate");
});

// Admin authenticated routes
Route::middleware("auth:admin")->group(function () {
    Route::post("logout", [AdminLoginController::class, "logout"])->name("admin.logout");
    Route::get("/", [DashboardController::class, "index"])->name("admin.dashboard");   //admin/ --> once the admin logs in this route redirect admin to the dashboard
    
    // Admin dashboard product management routes:
    Route::get('/products',[AdminProductController::class,'index'])->name('admin.products');
    Route::get('products/create',[AdminProductController::class,'create'])->name('admin.products.create');
    Route::post('/products/store',[AdminProductController::class,'store'])->name('admin.products.store');

    // edit-product routes
    Route::get('/products/edit/{id}',[AdminProductController::class,'edit'])->name('admin.products.edit');
    // dd(route('admin.products.update', ['product' => 1]));
    Route::put('/products/update/{id}',[AdminProductController::class,'update'])->name('admin.products.update');

    // delete-product routes:
    Route::delete('/products/{id}',[AdminProductController::class,'destroy'])->name('admin.products.delete');

    // categories management routes:
    Route::get('/categories', [AdminCategoryController::class,'index'])->name("admin.categories"); //convert it to index path
    Route::get('/categories/create',[AdminCategoryController::class,'create'])->name('admin.categories.create');
    Route::post('categories/store',[AdminCategoryController::class,'store'])->name('admin.categories.store');

    // edit category:
    Route::get('/categories/edit/{id}',[AdminCategoryController::class,'edit'])->name('admin.categories.edit');
    Route::put('/categories/update/{id}',[AdminCategoryController::class,'update'])->name('admin.categories.update');
    // delete category:
    Route::delete('/categories/{id}',[AdminCategoryController::class,'destroy'])->name('admin.categories.delete');

  


    // manage customers at admin side:
    Route::get("/customers", [AdminCustomerController::class, 'index'])->name('admin.customers');

    // edit customer:
    Route::get('/customers/edit/{id}',[AdminCustomerController::class,'edit'])->name('admin.customers.edit');
    Route::put('/customers/update/{id}',[AdminCustomerController::class,'update'])->name('admin.customers.update');

    // delete user/customer:
    Route::delete('/customrs/{id}',[AdminCustomerController::class,'destroy'])->name('admin.customers.delete');


    Route::view("/orders", "admin.orders")->name("admin.orders");
    });
});

