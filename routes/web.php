<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PrescriptionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
//Route::get('/', [UserController::class, 'index'])->name('dashboard')->middleware('guest');
Route::middleware(['auth', 'role:dokter,apoteker'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');

    Route::get('/patients', [PatientsController::class, 'index'])->name('patients');
    Route::get('/patients/data', [PatientsController::class, 'data'])->name('patients.data');
    Route::post('/patients', [PatientsController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}', [PatientsController::class, 'show'])->name('patients.show');

    Route::get('/patients/{id}/examine', [ExaminationsController::class, 'index'])->name('patients.examine');
    Route::post('/patients/{id}/examine', [ExaminationsController::class, 'store'])->name('patients.examine.store');
    Route::get('/patients/{id}/examine/{examineId}', [ExaminationsController::class, 'show'])->name(
        'patients.examine.show'
    );
    Route::get('/patients/{id}/data', [PatientsController::class, 'examinationData'])->name('patients.examine.data');

    Route::get('/prescriptions', [PrescriptionsController::class, 'index'])->name('prescriptions');
    Route::get('/prescriptions/data/{status?}', [PrescriptionsController::class, 'listPrescriptionsDataTable'])->name(
        'prescriptions.data'
    );
    Route::get('/prescriptions/{id}', [PrescriptionsController::class, 'show'])->name('prescriptions.show');
    Route::post('/prescriptions/{id}/updateStatus', [PrescriptionsController::class, 'editStatus'])->name(
        'prescriptions.updateStatus'
    );

    Route::get('/payments', [PaymentsController::class, 'index'])->name('payments');

    Route::post('/payments/{id}/updatePayment', [PaymentsController::class, 'updatePayment'])->name('payments.update');
    Route::get('/payments/{id}/receipt', [PaymentsController::class, 'downloadReceipt'])
        ->name('payments.receipt');
});
