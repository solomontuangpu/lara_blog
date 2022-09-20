<?php

use App\Models\Category;
Use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\NationController;

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

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::get('/detail/{slug}', [PageController::class, 'detail'])->name('page.detail');
// Route::get('/category/{category:slug}', [PageController::class, 'postByCategory'])->name('page.category');

// Route::get('/categories/{category:slug}', function (Category $category) {
//     $posts = $category->posts;
//     return view('index', compact('posts'));
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('nation', NationController::class);
    Route::resource('photo', PhotoController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
    Route::resource('user', UserController::class);
});

