<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::middleware(['role:dokter'])->group(function () {
//        Route::get('/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
        Route::get('/patient', [PatientController::class, 'index'])->name('patients.index');
        Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
        Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patient.show');
        Route::get('/patient/{id}/checkup', [ExaminationController::class, 'index'])->name('examination.index');
        Route::post('/patient/{id}/checkup', [ExaminationController::class, 'store'])->name('examination.store');
        Route::get('/patient/{id}/checkup/{idCheckUp}', [PrescriptionController::class, 'index'])->name(
            'prescriptions.index'
        );
        Route::post('/patient/{id}/checkup/{idCheckUp}', [PrescriptionController::class, 'store'])->name(
            'prescriptions.create'
        );
    });
    Route::middleware(['role:apoteker'])->group(function () {
//        Route::get('/apoteker/dashboard', [ApotekerController::class, 'index'])->name('apoteker.dashboard');
    });
});

Route::get('/1', function () {
    return view('doctor.dashboard');
});
Route::get('/2', function () {
    return view('doctor.patientsList');
});
Route::get('/3', function () {
    return view('doctor.addPatient');
});
Route::get('/4', function () {
    return view('doctor.patientDetail');
});
Route::get('/5', function () {
    return view('doctor.addExamination');
});
Route::get('/6', function () {
    return view('doctor.addPrescription');
});
