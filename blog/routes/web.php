<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BlogController::class, 'blog'])->name('blog');


Route::get('/post', [BlogController::class, 'post'])->name('post');

Route::get('single/{id}', [BlogController::class, 'single'])->name('post.show');

Route::post('/posts', [BlogController::class, 'store'])->name('posts.store');
Route::post('/posts/upload-image', [BlogController::class, 'uploadImage'])->name('posts.uploadImage');

Route::get('/load-more-posts', [BlogController::class, 'loadMorePosts'])->name('load.more.posts');
Route::get('/most-read-posts', [BlogController::class, 'showMostReadPosts'])->name('mostReadPosts');

Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
Route::post('/sideadvert', [BlogController::class, 'storeSideAdvert'])->name('sideadvert.store');
Route::post('/footeradvert', [BlogController::class, 'storeFooterAdvert'])->name('footeradvert.store');
Route::delete('/delete-advert/{type}/{id}', [BlogController::class, 'deleteAdvert'])->name('advert.delete');

Route::get('/get-adverts', [BlogController::class, 'getAdverts']);
Route::delete('/delete-post/{id}', [BlogController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/{id}/edit', [BlogController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [BlogController::class, 'update'])->name('posts.update');



