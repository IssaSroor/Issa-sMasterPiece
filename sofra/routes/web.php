<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;


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

Route::get('/', [KitchenController::class, 'index'])->name('home');
Route::get('kitchen/{id}', [KitchenController::class, 'show'])->name('kitchen.show');
// Route::get('/kitchen/{id}/menu', [Controller::class, 'index'])->name('kitchen.menu');
Route::get('allKitchens', [KitchenController::class, 'allKitchens'])->name('all');



Route::get('questions', [QuestionController::class, 'index'])->name('show');
Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes
    Route::get('login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store'])->name('login');
    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout')->middleware('auth:admin');

    // Admin dashboard and protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth:admin');
        Route::get('kitchens', [KitchenController::class, 'admin_index'])->name('kitchens.admin_index')->middleware('auth:admin');
        Route::get('kitchens/{id}', [KitchenController::class, 'show'])->name('kitchens.show')->middleware('auth:admin');
        Route::post('kitchens/{id}/approve', [KitchenController::class, 'approve'])->name('kitchens.approve')->middleware('auth:admin');
        Route::post('kitchens/{id}/reject', [KitchenController::class, 'reject'])->name('kitchens.reject')->middleware('auth:admin');
        Route::get('/admin/kitchens/{id}/show', [KitchenController::class, 'admin_show'])->name('kitchens.admin_show');

        Route::get('orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth:admin');
        Route::get('orders/kitchen/{kitchenId}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth:admin');

        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index')->middleware('auth:admin');
        Route::post('reviews/{id}/approve', [ReviewController::class, 'approve'])->name('reviews.approve')->middleware('auth:admin');
        Route::post('reviews/{id}/reject', [ReviewController::class, 'reject'])->name('reviews.reject')->middleware('auth:admin');

        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::get('questions', [QuestionController::class, 'index_admin'])->name('questions.index');
        Route::post('questions/{id}/resolve', [QuestionController::class, 'resolve'])->name('questions.resolve');
    });
    Route::middleware(['auth:admin', 'super_admin'])->group(function () {
        Route::get('/admins', [AdminAuthController::class, 'index'])->name('admins.index');
        Route::post('/admins', [AdminAuthController::class, 'register'])->name('admins.store');
        Route::get('/admins/create', [AdminAuthController::class, 'showaddpage'])->name('admins.create');
        Route::get('/admins/{id}/edit', [AdminAuthController::class, 'editadmin'])->name('admins.edit');
        Route::put('/admins/{id}', [AdminAuthController::class, 'updateadmin'])->name('admins.update');
        Route::delete('/admins/{id}', [AdminAuthController::class, 'destroyadmin'])->name('admins.destroy');
    });
});


require __DIR__ . '/auth.php';
