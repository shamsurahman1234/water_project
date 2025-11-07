<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MeterScanController; // ✅ اضافه شوی

// ----------------- Public Welcome Page -----------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------- Dashboard (protected) -----------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------- Authenticated Routes -----------------
Route::middleware('auth')->group(function () {

    // ----------------- Profile Routes -----------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------- Customers CRUD -----------------
    Route::resource('customers', CustomerController::class);

    // ----------------- Meters CRUD -----------------
    Route::resource('meters', MeterController::class);

    // ----------------- Meter Scan (📷 Mobile Camera Scan) -----------------
    Route::get('/meters/{meter}/scan', [MeterScanController::class, 'showScan'])->name('meters.scan');
    Route::post('/meters/{meter}/scan', [MeterScanController::class, 'processScan'])->name('meters.scan.process');

    // ----------------- Bills CRUD -----------------
    Route::resource('bills', BillController::class);

    // ----------------- Employees CRUD -----------------
    Route::resource('employees', EmployeeController::class);

    // ----------------- Payments (Stripe Online Payment) -----------------
    Route::get('/pay/{bill}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/pay/{bill}', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

require __DIR__ . '/auth.php';
