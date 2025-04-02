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
use  App\Http\Controllers\Admin\StaticpageController;


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
    Route::prefix('products')->group(function(){

        Route::get('/',[AdminProductController::class,'index'])->name('admin.products');
        Route::get('/create',[AdminProductController::class,'create'])->name('admin.products.create');
        Route::post('/store',[AdminProductController::class,'store'])->name('admin.products.store');
    
        // edit-product routes
        Route::get('/edit/{id}',[AdminProductController::class,'edit'])->name('admin.products.edit');
        // dd(route('admin.products.update', ['product' => 1]));
        Route::put('/update/{id}',[AdminProductController::class,'update'])->name('admin.products.update');
    
        // delete-product routes:
        Route::delete('/{id}',[AdminProductController::class,'destroy'])->name('admin.products.delete');

        // soft delete routes:
        Route::get('/deleted', [AdminProductController::class, 'deletedProducts'])->name('admin.products.deleted');
        Route::patch('/restore/{id}', [AdminProductController::class, 'restore']) ->name('admin.products.restore');
        Route::delete('/force-delete/{id}', [AdminProductController::class, 'forceDelete'])->name('admin.products.forceDelete');

    });


    // categories routes
    Route::prefix("categories")->group(function(){

        // categories management routes:
        Route::get('/', [AdminCategoryController::class,'index'])->name("admin.categories"); //convert it to index path
        Route::get('/create',[AdminCategoryController::class,'create'])->name('admin.categories.create');
        Route::post('/store',[AdminCategoryController::class,'store'])->name('admin.categories.store');
    
        // edit category:
        Route::get('/edit/{id}',[AdminCategoryController::class,'edit'])->name('admin.categories.edit');
        Route::put('/update/{id}',[AdminCategoryController::class,'update'])->name('admin.categories.update');
        // delete category:
        Route::delete('/{id}',[AdminCategoryController::class,'destroy'])->name('admin.categories.delete');

        // soft delete routes
        Route::get('/deleted', [AdminCategoryController::class, 'deletedCategories'])->name('admin.categories.deleted');
        Route::patch('/restore/{id}', [AdminCategoryController::class, 'restore']) ->name('admin.categories.restore');
        Route::delete('/force-delete/{id}', [AdminCategoryController::class, 'forceDelete'])->name('admin.categories.forceDelete');
    });

  

    // customer routes
    Route::prefix('customers')->group(function () {
        // manage customers at admin side:
        Route::get("/", [AdminCustomerController::class, 'index'])->name('admin.customers');
        // edit customer:
        Route::get('/edit/{id}',[AdminCustomerController::class,'edit'])->name('admin.customers.edit');
        Route::put('/update/{id}',[AdminCustomerController::class,'update'])->name('admin.customers.update');
        // delete user/customer:
        Route::delete('/{id}',[AdminCustomerController::class,'destroy'])->name('admin.customers.delete');
    });


Route::prefix('orders')->group(function () {

    Route::get("/",[AdminOrderController::class,'index'])->name("admin.orders.index");
    Route::get("/{id}",[AdminOrderController::class,'show'])->name("admin.orders.show");
    Route::put("/update/{id}",[AdminOrderController::class,'update'])->name("admin.order.update");
});
  
    // static block(pages) routes:

    Route::prefix('pages')->group(function () {

        Route::get('/', [AdminPageController::class, 'index'])->name('admin.pages.index');
        Route::get('/create', [AdminPageController::class, 'create'])->name('admin.pages.create');
        Route::post('/store',[AdminPageController::class, 'store'])->name('admin.pages.store');
        Route::get('/edit/{id}',[AdminPageController::class,'edit'])->name('admin.pages.edit');
        Route::put('/update/{id}',[AdminPageController::class,'update'])->name('admin.pages.update');
        Route::delete('/{id}',[AdminPageController::class,'destroy'])->name('admin.pages.destroy');
    });

    Route::prefix('staticPages')->group(function () {

        Route::get('/', [StaticpageController::class, 'index'])->name('admin.staticpages.index');
        Route::get('/create', [StaticpageController::class, 'create'])->name('admin.staticpages.create');
        Route::post('/store',[StaticpageController::class, 'store'])->name('admin.staticpages.store');
        Route::get('/edit/{id}',[StaticpageController::class,'edit'])->name('admin.staticpages.edit');
        Route::put('/update/{id}',[StaticpageController::class,'update'])->name('admin.staticpages.update');
        Route::delete('/{id}',[StaticpageController::class,'destroy'])->name('admin.staticpages.destroy');
    });

    });
});

