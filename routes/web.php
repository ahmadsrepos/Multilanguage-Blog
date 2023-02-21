<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\PageController;

use App\Http\Controllers\Website\IndexController as WebsiteIndexController;
use App\Http\Controllers\Website\CommentController as WebsiteCommentController;
use App\Http\Controllers\Website\PostController as WebsitePostController;
use App\Http\Controllers\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Website\PageController as WebsitePageController;
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

//Website
Route::get('/', [WebsiteIndexController::class, 'index'])->name('index');
Route::get('/post/{post}', [WebsitePostController::class, 'show'])->name('post');
Route::get('/category/{category}', [WebsiteCategoryController::class, 'show'])->name('category');
Route::post('/comment/store/{id}', [WebsiteCommentController::class, 'store'])->name('comment.store');
Route::get('/search', [WebsitePostController::class, 'search'])->name('search');
Route::get('/page/{id}/{name}', [WebsitePageController::class, 'show'])->name('page');

//Auth
Auth::routes();

//Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'checkifactivated']], function()
{
    Route::get('/', [IndexController::class, 'index'])->name('dashboard.index');

    Route::get('/settings', [SettingController::class, 'index'])->name('dashboard.settings');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('dashboard.settings.update');

    Route::resource('users', UserController::class);
    Route::get('/users-list', [UserController::class, 'usersList'])->name('users.list');
    Route::get('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::get('/users/final-delete/{id}', [UserController::class, 'finalDelete'])->name('users.final.delete');

    Route::resource("categories", CategoryController::class);
    Route::get('/categories-list', [CategoryController::class, 'categoriesList'])->name('categories.list');
    Route::get('/categories-minors', [CategoryController::class, 'categoriesMinors'])->name('categories.minors');
    Route::get('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('/categories/final-delete/{id}', [CategoryController::class, 'finalDelete'])->name('categories.final.delete');

    Route::resource("posts", PostController::class);
    Route::get('/posts-list', [PostController::class, 'postsList'])->name('posts.list');
    Route::get('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/posts/final-delete/{id}', [PostController::class, 'finalDelete'])->name('posts.final.delete');

    Route::resource("pages", PageController::class);
    Route::get('/pages-list', [PageController::class, 'pagesList'])->name('pages.list');
    Route::get('/pages/restore/{id}', [PageController::class, 'restore'])->name('pages.restore');
    Route::get('/pages/final-delete/{id}', [PageController::class, 'finalDelete'])->name('pages.final.delete');

    Route::resource("comments", CommentController::class);
    Route::get('/comments-list', [CommentController::class, 'commentsList'])->name('comments.list');
    Route::get('/comments/verify/{id}', [CommentController::class, 'verify'])->name('comments.verify');
});