<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['register' => false]);

// admin
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('departments', DepartmentController::class)->except('show');
    Route::resource('units', UnitController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('areas', AreaController::class)->except('show');
    Route::resource('racks', RackController::class)->except('show');
    Route::get('products/getById', [ProductController::class, 'getById'])->name('products.getById');
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class)->except('show');

    Route::post('stock-ins/create', [StockInController::class, 'store'])->name('stock-ins.store');
    Route::resource('stock-ins', StockInController::class)->except(['store', 'destroy']);
    Route::post('stock-outs/create', [StockOutController::class, 'store'])->name('stock-outs.store');
    Route::resource('stock-outs', StockOutController::class)->except(['store', 'destroy']);
});
