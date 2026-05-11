<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\AttendanceController;

// ── Public routes ──────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/join', [PublicController::class, 'join'])->name('public.join');
Route::get('/join/success', [PublicController::class, 'success'])->name('public.success');

// ── Admin routes ───────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('members', MemberController::class);
        Route::patch('/members/{member}/payment', [MemberController::class, 'markPaid'])->name('members.markPaid');

        Route::resource('workers', WorkerController::class);
        Route::resource('coaches', CoachController::class);

        Route::resource('attendance', AttendanceController::class);
        Route::get('/attendance/api/members-by-branch', [AttendanceController::class, 'getMembersByBranch'])->name('attendance.getMembersByBranch');

        Route::get('/branches',         [BranchController::class, 'index'])->name('branches.index');
        Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
    });
});
