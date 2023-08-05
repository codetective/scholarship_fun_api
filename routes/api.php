<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ScholarshipApplicationsController;
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

Route::middleware(['jwt.auth', 'isAdmin'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/docs', [DocumentsController::class, 'getDocs']);
    Route::get('/dashboard', [ScholarshipApplicationsController::class, 'fetchDashboard']);
    Route::get('/reviewed', [ScholarshipApplicationsController::class, 'fetchAllReviewed']);
    Route::get(
        '/unreviewed',
        [ScholarshipApplicationsController::class, 'fetchAllUnreviewed']
    );
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/checkAuth', [AuthController::class, 'checkAuth'])->middleware('jwt.auth');

Route::post('/apply', [ScholarshipApplicationsController::class, 'create']);
Route::post('/submit', [ScholarshipApplicationsController::class, 'submit']);

Route::post('/upload', [ScholarshipApplicationsController::class, 'upload']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('jwt.auth');
