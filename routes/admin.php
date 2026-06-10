<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    DashboardController,
    AdminDatasetController,
    AdminUserController,
    DatasetReviewController,
    UserManagementController,
    StatisticsController
};
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('datasets')->name('datasets.')->group(function () {
        Route::get('/', [DatasetReviewController::class, 'index'])->name('index');
        Route::get('/{dataset}', [DatasetReviewController::class, 'show'])->name('show');
        Route::get('/{dataset}/review', [DatasetReviewController::class, 'show'])->name('review');
        Route::post('/{dataset}/approve', [DatasetReviewController::class, 'approve'])->name('approve');
        Route::post('/{dataset}/reject', [DatasetReviewController::class, 'reject'])->name('reject');
        Route::post('/{dataset}/pending', [DatasetReviewController::class, 'setPending'])->name('pending');
        Route::post('/bulk-approve', [DatasetReviewController::class, 'bulkApprove'])->name('bulk-approve');
    });
    
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/{user}', [UserManagementController::class, 'show'])->name('show');
        Route::put('/{user}/role', [UserManagementController::class, 'updateRole'])->name('update-role');
        Route::post('/{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('toggle-status');
    });
   
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
    
    Route::get('/settings', function() {
        return view('admin.settings');
    })->name('settings');
});