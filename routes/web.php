<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : view('auth.login');
});

// Routes de pointage (Public ou Tablette Entrée)
Route::get('/pointage', [App\Http\Controllers\AttendanceController::class, 'kiosk'])->name('attendances.kiosk');
Route::post('/pointage/punch', [App\Http\Controllers\AttendanceController::class, 'punch'])->name('attendances.punch');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    Route::get('employees/{employee}/badge', [App\Http\Controllers\EmployeeController::class, 'showBadge'])->name('employees.badge');
    Route::resource('leaves', App\Http\Controllers\LeaveController::class);
    Route::resource('contracts', App\Http\Controllers\ContractController::class);
    Route::get('contracts/{contract}/pdf', [App\Http\Controllers\ContractController::class, 'showPdf'])->name('contracts.pdf');
    Route::get('departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments.index');
    Route::resource('attendances', App\Http\Controllers\AttendanceController::class)->only(['index', 'store']);
    Route::resource('users', App\Http\Controllers\UserController::class)->only(['index']);
    Route::post('leaves/{leave}/approve', [App\Http\Controllers\LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('leaves/{leave}/reject', [App\Http\Controllers\LeaveController::class, 'reject'])->name('leaves.reject');

        // Ajout du module recrutement
        Route::resource('recruitments', App\Http\Controllers\RecruitmentController::class);

        // Ajout des modules Performance, Rapport, Paiement et Formation
        Route::resource('performances', App\Http\Controllers\PerformanceController::class);
        Route::resource('trainings', App\Http\Controllers\TrainingController::class);
        Route::resource('payments', App\Http\Controllers\PaymentController::class);
        Route::resource('reports', App\Http\Controllers\ReportController::class)->only(['index']);
});