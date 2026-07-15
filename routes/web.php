<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Applications\ApplicationController;
use App\Http\Controllers\Applications\ArchiveController;
use App\Http\Controllers\Applications\AuditTrailController;
use App\Http\Controllers\Applications\StatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\PwdRegistrantController;

Route::view('/', 'landing')->name('home');
Route::get('/register', [PwdRegistrantController::class, 'createPublic'])->name('public.registration.create');
Route::post('/register', [PwdRegistrantController::class, 'storePublic'])->name('public.registration.store');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('/login/2fa', [TwoFactorController::class, 'showLoginChallenge'])->name('login.2fa.show');
    Route::post('/login/2fa', [TwoFactorController::class, 'verifyLoginChallenge'])->name('login.2fa.verify');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/settings/password', [AuthenticatedSessionController::class, 'editPassword'])->name('settings.password');
    Route::post('/settings/password', [AuthenticatedSessionController::class, 'updatePassword'])->name('settings.password.update');
    Route::get('/settings/google-authenticator', [\App\Http\Controllers\Auth\TwoFactorController::class, 'showSettings'])->name('settings.google-authenticator');
    Route::post('/settings/google-authenticator/enable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'enable'])->name('settings.google-authenticator.enable');
    Route::post('/settings/google-authenticator/disable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'disable'])->name('settings.google-authenticator.disable');
    Route::resource('registrants', PwdRegistrantController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('/archive-applications', [ArchiveController::class, 'index'])->name('applications.archive');
    Route::get('/audit-trail', [AuditTrailController::class, 'index'])->name('applications.audit-trail');
    Route::post('/applications/{application}/restore', [ArchiveController::class, 'restore'])->name('applications.restore');
    Route::patch('/applications/{application}/status', [StatusController::class, 'update'])->name('applications.status');
    Route::resource('applications', ApplicationController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
});
