<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/deposite', [TransactionController::class, 'deposite'])->name('transaction.deposite');
    Route::post('/deposite-amount', [TransactionController::class, 'depositeAmount'])->name('transaction.deposite.amount');

    Route::get('/widraw', [TransactionController::class, 'widraw'])->name('transaction.widraw');
    Route::post('/withdraw-amount', [TransactionController::class, 'withdrawAmount'])->name('transaction.widraw.amount');

    Route::get('/transfer', [TransactionController::class, 'transfer'])->name('transaction.transfer');
    Route::post('/transfer-amount', [TransactionController::class, 'transferAmount'])->name('transaction.transfer.amount');

    Route::get('/statement', [TransactionController::class, 'statement'])->name('transaction.statement');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
