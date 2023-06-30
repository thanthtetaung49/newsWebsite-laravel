<?php

use App\Http\Controllers\AdminListController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Authentication / profile
    Route::get('/dashboard', [AuthController::class, 'auth'])->name('profile');
    Route::post('/user/update', [AuthController::class, 'userUpdate'])->name('userUpdate');
    Route::get('/changePassword', [AuthController::class, 'userChangePassword'])->name('userChangePassword');
    Route::post('/user/changePassword', [AuthController::class, 'changePasswordUpdate'])->name('userChangePasswordUpdate');

    // Admin list
    Route::get('/admin/list', [AdminListController::class, 'index'])->name('admin#list');
    Route::get('/account/delete/{id}', [AdminListController::class, "accountDelete"])->name('admin#accountDelete');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/submit', [CategoryController::class, 'categorySubmit'])->name('categorySubmit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete');
    Route::get('/category/update/', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');

    // post
    Route::get('/post', [PostController::class, 'index'])->name('post');
    Route::post('/post/create', [PostController::class, 'postCreate'])->name('postCreate');
    Route::get('/post/delete/{id}', [PostController::class, 'postDelete'])->name('postDelete');
    Route::get('/post/edit/{id}', [PostController::class, 'postEdit'])->name('postEdit');
    Route::post('/post/update/{id}', [PostController::class, 'postUpdate'])->name('postUpdate');

    // trend post
    Route::get('/trendPost', [TrendPostController::class, 'index'])->name('trendPost');
    Route::get('/trendPost/details/{id}', [TrendPostController::class, 'trendPostDetail'])->name('trendPostDetail');
});
