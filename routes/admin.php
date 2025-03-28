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
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPageController;



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
    Route::get('/products/create',[AdminProductController::class,'create'])->name('admin.products.create');
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
    Route::post('/categories/store',[AdminCategoryController::class,'store'])->name('admin.categories.store');

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
    Route::delete('/customers/{id}',[AdminCustomerController::class,'destroy'])->name('admin.customers.delete');


    Route::get("/orders",[AdminOrderController::class,'index'])->name("admin.orders.index");
    Route::get("/orders/{id}",[AdminOrderController::class,'show'])->name("admin.orders.show");
    Route::put("/orders/update/{id}",[AdminOrderController::class,'update'])->name("admin.order.update");
  
    // Route::get('/banner/edit', [BannerController::class, 'edit'])->name('banner.edit');
    // Route::put('/banner/update', [BannerController::class, 'update'])->name('banner.update');

    Route::get('/pages', [AdminPageController::class, 'index'])->name('admin.pages.index');
    Route::get('/pages/create', [AdminPageController::class, 'create'])->name('admin.pages.create');
    Route::post('/pages/store',[AdminPageController::class, 'store'])->name('admin.pages.store');
    Route::get('/pages/edit/{id}',[AdminPageController::class,'edit'])->name('admin.pages.edit');
    Route::put('/pages/update/{id}',[AdminPageController::class,'update'])->name('admin.pages.update');
    Route::delete('/pages/{id}',[AdminPageController::class,'destroy'])->name('admin.pages.destroy');

    });
});

