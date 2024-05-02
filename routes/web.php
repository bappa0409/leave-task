<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'showLoginPage'])->name('admin.login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/leave-requests-data', [DashboardController::class, 'getLeaveRequestsData'])->name('getLeaveRequestsData');
    Route::get('/user-wise-leave-requests-data', [DashboardController::class, 'userWiseGetLeaveRequestsData'])->name('userWiseGetLeaveRequestsData');
    
    
    //For Profile Update
    Route::get('/profile', [ProfileController::class, 'profilePageShow'])->name('profile_page_show');
    Route::post('/profile-update/{id:id}', [ProfileController::class, 'profileUpdate'])->name('profile.update');


    // Route for Staff
    Route::group(['prefix' => 'staff', 'middleware' => 'auth'], function () {
        Route::name('staff.')->group(function () {
            Route::controller(StaffController::class)->group(function () {
                Route::get('/list', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id:id}', 'edit')->name('edit');
                Route::post('/update/{id:id}', 'update')->name('update');
                Route::delete('/destroy/{id:id}', 'destroy')->name('destroy');
                Route::get('/status-change/{id:id}', 'statusChange')->name('status_change');
                Route::post('/registration-approve/{id:id}', 'approve')->name('approve');
            });
        });
    });

    // Route for Leave Request
    Route::group(['prefix' => 'leave-request', 'middleware' => 'auth'], function () {
        Route::name('leave_request.')->group(function () {
            Route::controller(LeaveRequestController::class)->group(function () {
                Route::get('/list', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id:id}', 'edit')->name('edit');
                Route::post('/update/{id:id}', 'update')->name('update');
                Route::delete('/destroy/{id:id}', 'destroy')->name('destroy');
                Route::post('/leave-request-approve/{id:id}', 'approve')->name('approve');
                Route::post('/leave-request-cancel/{id:id}', 'cancel')->name('cancel');
            });
        });
    });
});
