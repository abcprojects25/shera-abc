<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// Authentication routes (Laravel Breeze provides these)
require __DIR__.'/auth.php';

// Default dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');   
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/  

Route::get('/', function () {
    return view('frontend.index');
})->name('frontend.index');

    
Route::get('/about-us', function () {
    return view('frontend.about-us');
});

Route::get('/products', function () {
    return view('frontend.products');
});

Route::get('/product-description', function () {
    return view('frontend.product-description');
});

Route::get('/project', function () {
    return view('frontend.project');
});

Route::get('/deco-boards', function () {
    return view('frontend.deco-boards');
});

Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});

Route::get('/admin/products/products_lists', [ProductController::class, 'index'])->name('admin.products.products_lists');
Route::get('/admin/products/add_products', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/products/products_lists', [ProductController::class, 'store'])->name('products.store');
Route::post('/admin/products/images/reorder', [ProductController::class, 'reorderImages']);
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::delete('/admin/products/images/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.deleteImage');


Route::prefix('admin/products')->name('admin.products.')->middleware('auth')->group(function () {
    Route::resource('product_categories', CategoryController::class);
});





