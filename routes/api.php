<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Book Route Things
Route::get('/book', [BookController::class, 'index'])->middleware(['auth:sanctum']); // Show Book List
Route::get('/search', [BookController::class, 'search']);
Route::get('/book/{id}', [BookController::class, 'detail'])->middleware(['auth:sanctum']); // Show Book Detail
Route::post('/book', [BookController::class, 'addBook'])->middleware(['auth:sanctum', 'admin']); // Add Book to Database (Admin only)
Route::patch('/book/{id}', [BookController::class, 'update'])->middleware(['auth:sanctum', 'admin']);
Route::delete('/book/{id}', [BookController::class, 'delete'])->middleware(['auth:sanctum', 'admin']);

// Authentication Route Things
Route::post('/login', [AuthController::class, 'login']); // Login to an account
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']); // Log out from an account
Route::get('/account', [AuthController::class, 'accountDetail'])->middleware(['auth:sanctum']); // Show Account Detail

// Review Route Things
Route::post('/review', [ReviewController::class, 'store'])->middleware(['auth:sanctum']);
Route::patch('/review/{id}', [ReviewController::class, 'update']);
Route::delete('/review/{id}', [ReviewController::class, 'delete']);