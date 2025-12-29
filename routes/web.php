<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Auth routes
require __DIR__.'/auth.php';

// Additional auth check route for Vue
Route::get('/check-auth', [App\Http\Controllers\Auth\LoginController::class, 'check'])->name('check-auth');

// Admin API routes (protected by auth, using web middleware for sessions)
Route::middleware('auth')->prefix('api/admin')->group(function () {
    Route::apiResource('blogs', App\Http\Controllers\Api\Admin\BlogController::class);
    Route::apiResource('programs', App\Http\Controllers\Api\Admin\ProgramController::class);
    Route::apiResource('events', App\Http\Controllers\Api\Admin\EventController::class);
    Route::get('/contact-messages', [App\Http\Controllers\Api\Admin\ContactMessageController::class, 'index']);
    Route::put('/contact-messages/{id}/read', [App\Http\Controllers\Api\Admin\ContactMessageController::class, 'markAsRead']);
    Route::delete('/contact-messages/{id}', [App\Http\Controllers\Api\Admin\ContactMessageController::class, 'destroy']);
});

// Vue.js SPA catch-all route (must be last)
Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '.*');
