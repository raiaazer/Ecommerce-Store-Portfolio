<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
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

Auth::routes();

// user route
Route::middleware(['auth', 'user-role:user'])->group(function(){
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');
});

// editor route
Route::middleware(['auth', 'user-role:editor'])->group(function(){
    Route::get('/editor/home', [HomeController::class, 'editorHome'])->name('home.editor');
});

// user admin
Route::middleware(['auth', 'user-role:admin'])->group(function(){
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/product', 'ProductController');

    Route::post('/variationType', [ProductController::class, 'variationType']);

    Route::post('/upload', [ProductController::class, 'upload']);

    Route::post('/upload/remove', [ProductController::class, 'uploadRemove'])->name('upload.remove');
    Route::post('/delete-image', [ProductController::class, 'deleteImage'])->name('delete.image');



});
