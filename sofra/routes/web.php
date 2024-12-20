<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

Route::post('/send-message', [KitchenController::class, 'storeMessage'])->name('send.message');

Route::post('/reviews/check-purchased', [ReviewController::class, 'checkPurchased']);

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('allKitchens', [KitchenController::class, 'allKitchens'])->name('all');

Route::get('/kitchen/{kitchenId}/menu', [KitchenController::class, 'showMenu'])->name('menu');

Route::get('/cart', [CartController::class, 'index'])->name('cart.view');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

Route::get('/thank-you', function () {
    return view('thankyou');
})->name('thankyou.page');

Route::get('/about', function () {
    return view('about-us');
})->name('about');


Route::middleware(['auth:owner'])->group(function () {
    Route::get('/kitchen.register', [KitchenController::class, 'showRegistrationForm'])->name('kitchen.register.page');
    Route::post('/kitchen/register', [KitchenController::class, 'registerKitchen'])->name('kitchen.register.submit');
    Route::get('/kitchen/{id}/profile', [KitchenController::class, 'profile'])->name('kitchen.profile');
    Route::get('/kitchen/{id}/orders', [KitchenController::class, 'orders'])->name('kitchen.orders');
    Route::get('/kitchen/{id}/messages', [KitchenController::class, 'messages'])->name('kitchen.messages');
    Route::get('/kitchen/{id}/items', [KitchenController::class, 'items'])->name('kitchen.items');
    Route::get('/kitchen/{id}/edit', [KitchenController::class, 'edit'])->name('kitchen.edit');
    Route::put('/kitchen/{id}/update', [KitchenController::class, 'update'])->name('kitchen.update');
    Route::get('/kitchen/{id}/items/add', [KitchenController::class, 'addItem'])->name('kitchen.items.add');
    Route::post('/kitchen/{id}/items/add', [KitchenController::class, 'storeItem'])->name('kitchen.items.store');

    Route::get('/kitchen/{kitchen_id}/items/{item_id}', [KitchenController::class, 'showItem'])->name('kitchen.items.view');

    // Route to edit a single item
    Route::get('/kitchen/{kitchen_id}/items/{item_id}/edit', [KitchenController::class, 'editItem'])->name('kitchen.items.edit');

    // Route to update the item (POST request)
    Route::post('/kitchen/{kitchen_id}/items/{item_id}', [KitchenController::class, 'updateItem'])->name('kitchen.items.update');

    // Route to delete an item
    Route::delete('/kitchen/{kitchen_id}/items/{item_id}', [KitchenController::class, 'destroy'])->name('kitchen.items.delete');

    Route::put('/owner/profile/{id}', [OwnerController::class, 'updateProfile'])->name('owner.profile.update');
    Route::get('/owner/profile/{id}', [OwnerController::class, 'profile'])->name('owner.profile');

    Route::post('/logout', [KitchenController::class, 'logout'])->name('owner.logout');


});




// Route to edit the order
Route::get('/kitchen/{id}/orders/{order_id}/edit', [OrderController::class, 'edit'])
    ->name('kitchen.orders.edit');

// Route to view the order
Route::get('/kitchen/{id}/orders/{order_id}/view', [OrderController::class, 'view'])
    ->name('kitchen.orders.view');

// Route to update the order status
Route::put('/kitchen/{id}/orders/{order_id}/update', [OrderController::class, 'update'])
    ->name('kitchen.orders.update');


Route::get('questions', [QuestionController::class, 'index'])->name('show');
Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/account-info', [UserController::class, 'accountInfo'])->name('user.account-info');
    Route::put('/dashboard/account-info', [UserController::class, 'updateAccount'])->name('user.update-account');
    Route::get('/dashboard/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{id}', [UserController::class, 'showOrder'])->name('orders.show');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::prefix('owner')->group(function () {
    Route::get('register', [OwnerController::class, 'showRegisterForm'])->name('owner.register');
    Route::post('register', [OwnerController::class, 'register']);
    Route::get('login', [OwnerController::class, 'showLoginForm'])->name('owner.login');
    Route::post('login', [OwnerController::class, 'login'])->name('owner.login');
    Route::post('logout', [OwnerController::class, 'logout'])->name('owner.logout');

    Route::get('dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes
    Route::get('login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store'])->name('login');
    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');

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
