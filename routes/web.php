<?php

use App\Http\Controllers\ActiveIngredientController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DrugStoreController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
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
Route::get('/ingredient', [ActiveIngredientController::class, 'index'])->name('ingredient.index');
Route::post('/ingredient', [ActiveIngredientController::class, 'store'])->name('ingredient.store');
Route::get('/ingredient/{ingredient}', [ActiveIngredientController::class, 'edit'])->name('ingredient.edit');
Route::put('/ingredient/{ingredient}', [ActiveIngredientController::class, 'update'])->name('ingredient.update');
Route::delete('/ingredient/{ingredient}', [ActiveIngredientController::class, 'destroy'])->name('ingredient.destroy');

//Remédios
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicine.index');
Route::get('/create-medicines', [MedicineController::class, 'create'])->name('medicine.create');
Route::post('/store-medicine', [MedicineController::class, 'store'])->name('medicine.store');
// Route::get('/show-medicine/{medicine}', [MedicineController::class, 'show'])->name('medicine.show');
Route::get('/edit-medicine/{medicine}', [MedicineController::class, 'edit'])->name('medicine.edit');
Route::put('/edit-medicine/{medicine}', [MedicineController::class, 'update'])->name('medicine.update');
Route::delete('/medicine/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.destroy');

//Promoções
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotion.index');
Route::get('/create-promotions', [PromotionController::class, 'create'])->name('promotion.create');
Route::post('/store-promotion', [PromotionController::class, 'store'])->name('promotion.store');
// Route::get('/show-promotion/{promotion}', [PromotionController::class, 'show'])->name('promotion.show');
Route::get('/edit-promotion/{promotion}', [PromotionController::class, 'edit'])->name('promotion.edit');
Route::put('/edit-promotion/{promotion}', [PromotionController::class, 'update'])->name('promotion.update');
Route::delete('/promotion/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy');

//Estoque
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/create-stock', [StockController::class, 'create'])->name('stock.create');
Route::post('/store-stock', [StockController::class, 'store'])->name('stock.store');
// Route::get('/show-stock/{stock}', [StockController::class, 'show'])->name('stock.show');
Route::get('/edit-stock/{stock}', [StockController::class, 'edit'])->name('stock.edit');
Route::put('/edit-stock/{stock}', [StockController::class, 'update'])->name('stock.update');
Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

//Orçamentos
Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
//Filais
Route::get('/drugstore', [DrugStoreController::class, 'index'])->name('drugstore.index');
// Estoque
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// Vendas
Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');