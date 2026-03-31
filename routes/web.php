<?php
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::resource('services', ServiceController::class);
Route::resource('postes', PosteController::class); 
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::resource('conges', CongeController::class);
Route::resource('employes', EmployeController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('absences', AbsenceController::class);
Route::resource('presences', PresenceController::class);