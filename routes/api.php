<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes
Route::get('/programs', [App\Http\Controllers\Api\ProgramController::class, 'index']);
Route::get('/programs/{id}', [App\Http\Controllers\Api\ProgramController::class, 'show']);

Route::get('/events', [App\Http\Controllers\Api\EventController::class, 'index']);
Route::get('/events/{id}', [App\Http\Controllers\Api\EventController::class, 'show']);

Route::get('/blogs', [App\Http\Controllers\Api\BlogController::class, 'index']);
Route::get('/blogs/{slug}', [App\Http\Controllers\Api\BlogController::class, 'show']);

Route::get('/pages', [App\Http\Controllers\Api\PageController::class, 'index']);
Route::get('/pages/{slug}', [App\Http\Controllers\Api\PageController::class, 'show']);

Route::post('/donations', [App\Http\Controllers\Api\DonationController::class, 'store']);
Route::post('/donations/payment-intent', [App\Http\Controllers\Api\DonationController::class, 'createPaymentIntent']);
Route::post('/volunteers', [App\Http\Controllers\Api\VolunteerController::class, 'store']);
Route::post('/contact', [App\Http\Controllers\Api\ContactController::class, 'store']);

// Admin API routes
Route::middleware(['auth:web'])->group(function () {
    // Contact Messages Management
    Route::get('/contact-messages', [App\Http\Controllers\Api\ContactController::class, 'index']);
    Route::delete('/contact-messages/{id}', [App\Http\Controllers\Api\ContactController::class, 'destroy']);
    Route::delete('/contact-messages', [App\Http\Controllers\Api\ContactController::class, 'destroyAll']);
    
    // Programs Management
    Route::post('/programs', [App\Http\Controllers\Api\ProgramController::class, 'store']);
    Route::put('/programs/{id}', [App\Http\Controllers\Api\ProgramController::class, 'update']);
    Route::delete('/programs/{id}', [App\Http\Controllers\Api\ProgramController::class, 'destroy']);
    
    // Events Management
    Route::post('/events', [App\Http\Controllers\Api\EventController::class, 'store']);
    Route::put('/events/{id}', [App\Http\Controllers\Api\EventController::class, 'update']);
    Route::delete('/events/{id}', [App\Http\Controllers\Api\EventController::class, 'destroy']);
});
