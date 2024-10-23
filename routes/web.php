<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\UkmController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\EnsureUserIsAuthenticated;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/category/{id}', [LandingController::class, 'category'])->name('landing.category');
Route::get('/search', [LandingController::class, 'search'])->name('landing.search');
Route::get('/detail/{id}', [LandingController::class, 'show'])->name('landing.detail');
Route::get('/umkm/{id?}', [LandingController::class, 'ukm'])->name('landing.umkm');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-proccess', [AuthController::class, 'login'])->name('login-proccess');

Route::middleware([EnsureUserIsAuthenticated::class])->prefix('admin')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [categoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan');
    Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
    Route::post('/satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
    Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit'])->name('satuan.edit');
    Route::post('/satuan/update', [SatuanController::class, 'update'])->name('satuan.update');
    Route::delete('/satuan/delete/{id}', [SatuanController::class, 'delete'])->name('satuan.delete');

    Route::get('/umkm', [UkmController::class, 'index'])->name('ukm');
    Route::get('/umkm/create', [UkmController::class, 'create'])->name('ukm.create');
    Route::post('/umkm/store', [UkmController::class, 'store'])->name('ukm.store');
    Route::get('/umkm/edit/{id}', [UkmController::class, 'edit'])->name('ukm.edit');
    Route::post('/umkm/update', [UkmController::class, 'update'])->name('ukm.update');
    Route::delete('/umkm/delete/{id}', [UkmController::class, 'delete'])->name('ukm.delete');
    Route::get('/export-pdf/{id}', [UkmController::class, 'exportPDF'])->name('export.pdf');


    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
});