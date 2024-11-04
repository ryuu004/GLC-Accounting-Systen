<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AnalysisController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.index');

Route::resource('orders', OrderController::class);
Route::resource('expenses', ExpenseController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('clients', ClientController::class);
