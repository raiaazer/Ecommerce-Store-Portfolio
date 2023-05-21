<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserProductController;

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user.index');
// });
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::resource('/cart', 'CartController');
Route::get('/cart/store/{id}', [CartController::class, 'store'])->name('cart.store');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/user/category', [UserCategoryController::class, 'category'])->name('user.category');
Route::get('/user/product', [UserProductController::class, 'product'])->name('user.product');

Route::post('/products/filter', [UserProductController::class, 'filterByPrice'])->name('products.filterByPrice');
// Route::get('/user/product/filter', [UserProductController::class, 'productsfilter'])->name('user.products.filter');


Auth::routes();

Route::middleware(['auth', 'user-role:user'])->group(function(){
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');

});

Route::middleware(['auth', 'user-role:editor'])->group(function(){
    Route::get('/editor/home', [HomeController::class, 'editorHome'])->name('home.editor');
});

Route::middleware(['auth', 'user-role:admin'])->group(function(){
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/product', 'ProductController');

    Route::post('/variationType', [ProductController::class, 'variationType']);
    Route::post('/upload', [ProductController::class, 'upload']);
    Route::post('/upload/remove', [ProductController::class, 'uploadRemove'])->name('upload.remove');
    Route::post('/delete-image', [ProductController::class, 'deleteImage'])->name('delete.image');

    Route::get('/site/settings', [SiteController::class, 'SiteSettings'])->name('site.settings');
    Route::post('/site/store', [SiteController::class, 'store'])->name('site.store');
    // Route::delete('site/banner-image/{id}', [SiteController::class, 'deleteBannerImage'])->name('site.deleteBannerImage');

    Route::delete('/site/banner-image/{filename}', [SiteController::class, 'deleteBannerImage'])->name('site.deleteBannerImage');
    // Route::post('/site/update', [SiteController::class, 'update'])->name('site.update');
    Route::post('/site/{id}/update', [SiteController::class, 'update'])->name('site.update');

});
