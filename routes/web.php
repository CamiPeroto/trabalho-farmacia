<?php

use App\Http\Controllers\ActiveIngredientController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ecommerce.home.index');
});

//Login
// Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
// Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy'); 
// Route::get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
// Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');
//Recuperar senha
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])
// ->name('forgot-password.show');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])
// ->name('forgot-password.submit');
// Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])
// ->name('password.reset');
// Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])
// ->name('reset-password.submit');

//Princípio Ativo
Route::get('/active-ingredient', [ActiveIngredientController::class, 'index'])->name('active-ingredient.index');
//Remédios
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicine.index');
//Orçamentos
Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');