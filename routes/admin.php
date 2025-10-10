<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Gestión Roles
Route::resource('roles', RoleController::class)->except('show');

// Gestión Usuarios
Route::resource('users', UserController::class)->except('show');

// Gestión Pacientes
Route::resource('patients', PatientController::class)->only(['index','edit', 'update']);

// Gestión Doctores
Route::resource('doctors', DoctorController::class)->only(['index','edit', 'update']);
Route::get('doctors/{doctor}/schedules', [DoctorController::class, 'schedules'])->name('doctors.schedules');