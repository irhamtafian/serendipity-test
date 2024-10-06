<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller Backend

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminArticlesController;
use App\Http\Controllers\Backend\AdminArticleCategoriesController;
use App\Http\Controllers\Backend\AdminArticleCommentsController;

use App\Http\Controllers\Backend\BlankController;

// Controller Frontend

use App\Http\Controllers\Frontend\ArticlesController;

Route::get('/login', function () {return redirect('/admin/login');});
Route::get('/admin', function () {return redirect('/admin/login');});

// Route Backend

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminAuthController::class, 'register'])->middleware('guest');
    Route::post('/register', [AdminAuthController::class, 'store_register']);
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'authenticate']);
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    // Route::post('/articles/logout', [AdminAuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/articles/logout', [AdminAuthController::class, 'logout']);
        Route::resource('/articles', AdminArticlesController::class)->except(['show']);
        Route::resource('/articles/categories', AdminArticleCategoriesController::class)->except(['create', 'show']);
        Route::get('/articles/comments', [AdminArticleCommentsController::class, 'index'])->name('comments.index');
        Route::put('/articles/comments/{id}/publish', [AdminArticleCommentsController::class, 'publish'])->name('comments.publish');
        Route::delete('/articles/comments/{id}/delete', [AdminArticleCommentsController::class, 'delete'])->name('comments.delete');
        Route::get('/users', [AdminAuthController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminAuthController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminAuthController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminAuthController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminAuthController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [AdminAuthController::class, 'destroy'])->name('users.destroy');
    });
    
});

// Route Frontend
Route::get('/', function () {return redirect('/articles');});
Route::get('/home', function () {return redirect('/articles');});
Route::get('/beranda', function () {return redirect('/articles');});

Route::get('/articles', [ArticlesController::class, 'index'])->name('front.articles.index');
Route::get('/articles', [ArticlesController::class, 'article'])->name('front.article');
Route::get('/articles/category/{slug}', [ArticlesController::class, 'categoryArticle'])->name('front.category');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('front.show_article');
Route::post('/comment', [ArticlesController::class, 'comment']);
Route::post('/bookmarks', [ArticlesController::class, 'bookmark'])->name('articles.bookmark');
Route::get('/bookmarks', [ArticlesController::class, 'viewBookmark'])->name('articles.bookmark.view');

// Route::get('/blank', [BlankController::class, 'index']);