<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication
Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);

// Route::get('/category', [ApiController::class, 'category']);

// post
Route::get('/post/data', [ApiController::class, 'post']);
Route::post('/post/search', [ApiController::class, 'postSearch']);
Route::post('/detailnews', [ApiController::class, 'newsDetail']);
Route::post('/post/viewCount', [ApiController::class, 'postViewCount']);

// category
Route::get('/post/categoryData', [ApiController::class, 'category']);
Route::post('/category/search', [Apicontroller::class, 'categorySearch']);
