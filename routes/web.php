<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::post('payments/notification', [\App\Http\Controllers\PaymentController::class, 'notification'])->name('payment.notification');
Route::get('payments/completed', [\App\Http\Controllers\PaymentController::class, 'completed'])->name('payment.completed');
Route::get('payments/failed', [\App\Http\Controllers\PaymentController::class, 'failed'])->name('payment.failed');
Route::get('payments/unfinish', [\App\Http\Controllers\PaymentController::class, 'unfinish'])->name('payment.unfinish');

Route::get('text', function () {
    return view('frontend.payments.success');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

Route::get('search', [\App\Http\Controllers\ShopController::class, 'search'])->name('search');
Route::get('shop/{slug?}', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('shop/tag/{slug}', [\App\Http\Controllers\ShopController::class, 'tag'])->name('shop.tag');
Route::get('product/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

Route::get('blog', function () {
    return view('frontend.blog.index');
});

Route::get('contact', function () {
    return view('frontend.contact.index');
});
Route::get('faqs', function () {
    return view('frontend.faqs.index');
});
Route::get('refund', function () {
    return view('frontend.refund.index');
});
Route::get('returns', function () {
    return view('frontend.returns.index');
});
Route::get('support', function () {
    return view('frontend.support.index');
});
Route::get('order', function () {
    return view('frontend.order.index');
});
Route::get('company', function () {
    return view('frontend.company.index');
});
Route::get('store', function () {
    return view('frontend.store.index');
});

Route::get('frontend', function () {
    return view('frontend.homepage');
});

Route::get('checkout', function () {
    return view('frontend.checkout.index');
});

Route::post('/admin/users', 'UserController@store')->name('admin.users.store');

Route::resource('favorite', \App\Http\Controllers\FavoriteController::class)->only(['index', 'store', 'destroy']);
Route::resource('cart', \App\Http\Controllers\CartController::class)->only(['index', 'store', 'update', 'destroy']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [\App\Http\Controllers\Auth\ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [\App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile.update');

    Route::get('orders/checkout', [\App\Http\Controllers\OrderController::class, 'process'])->name('checkout.process');
    Route::get('orders/cities', [\App\Http\Controllers\OrderController::class, 'cities']);
    Route::post('orders/shipping-cost', [\App\Http\Controllers\OrderController::class, 'shippingCost']);
    Route::post('orders/set-shipping', [\App\Http\Controllers\OrderController::class, 'setShipping']);
    Route::post('orders/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
    Route::get('orders/received/{orderId}', [\App\Http\Controllers\OrderController::class, 'received'])->name('checkout.received');
    Route::get('orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('orders/{orderId}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::post('/products/remove-image', [\App\Http\Controllers\Admin\ProductController::class, 'removeImage'])->name('products.removeImage');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class)->only(['index', 'edit', 'update', 'destroy', 'show']);
    Route::resource('slides', \App\Http\Controllers\Admin\SlideController::class);
    Route::get('slides/{slideId}/up', [\App\Http\Controllers\Admin\SlideController::class, 'moveUp']);
    Route::get('slides/{slideId}/down', [\App\Http\Controllers\Admin\SlideController::class, 'moveDown']);

    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'destroy']);
    Route::get('orders/{orderId}/cancel', [\App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('orders/cancel/{orderId}', [\App\Http\Controllers\Admin\OrderController::class, 'cancelUpdate'])->name('orders.cancelUpdate');
    Route::post('orders/complete/{orderId}', [\App\Http\Controllers\Admin\OrderController::class, 'complete'])->name('orders.complete');
    Route::resource('shipments', \App\Http\Controllers\Admin\ShipmentController::class)->only(['index', 'edit', 'update']);

    Route::get('reports/revenue', [\App\Http\Controllers\Admin\ReportController::class, 'revenue'])->name('reports.revenue');
});
});

Auth::routes();
