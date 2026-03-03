<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/register', [PageController::class, 'registerForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/register/confirmation/{code}', [PageController::class, 'confirmation'])->name('register.confirmation');

// Agreement signing (signed URL - no login required)
Route::get('/agreements/{agreement}/sign', [AgreementController::class, 'sign'])
    ->name('agreements.sign')
    ->middleware('signed');
Route::get('/agreements/{agreement}/complete', [AgreementController::class, 'complete'])
    ->name('agreements.complete');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Registrations
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('dashboard.registrations.index');
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('dashboard.registrations.show');

    // Agreements
    Route::get('/agreements', [AgreementController::class, 'index'])->name('dashboard.agreements.index');
    Route::get('/agreements/start/{registration}', [AgreementController::class, 'startAgreement'])->name('dashboard.agreements.start');
    Route::post('/agreements/create/{registration}', [AgreementController::class, 'create'])->name('dashboard.agreements.create');
    Route::get('/agreements/{agreement}', [AgreementController::class, 'show'])->name('dashboard.agreements.show');
    Route::get('/agreements/{agreement}/pdf', [AgreementController::class, 'pdf'])->name('dashboard.agreements.pdf');

    // Fleet
    Route::get('/fleet', [FleetController::class, 'index'])->name('dashboard.fleet.index');
    Route::get('/fleet/create', [FleetController::class, 'create'])->name('dashboard.fleet.create');
    Route::post('/fleet', [FleetController::class, 'store'])->name('dashboard.fleet.store');
    Route::get('/fleet/{vehicle}', [FleetController::class, 'show'])->name('dashboard.fleet.show');
    Route::get('/fleet/{vehicle}/edit', [FleetController::class, 'edit'])->name('dashboard.fleet.edit');
    Route::put('/fleet/{vehicle}', [FleetController::class, 'update'])->name('dashboard.fleet.update');
    Route::delete('/fleet/{vehicle}', [FleetController::class, 'destroy'])->name('dashboard.fleet.destroy');
});
