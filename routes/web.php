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

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process'); 
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy'); 

Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');

//Recuperar senha
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])
// ->name('forgot-password.show');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])
// ->name('forgot-password.submit');
// Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])
// ->name('password.reset');
// Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])
// ->name('reset-password.submit');

//Rotas privadas
Route::group(['middleware' => 'auth'], function()
{
//Princípio Ativo
Route::get('/ingredient', [ActiveIngredientController::class, 'index'])->name('ingredient.index')->middleware('permission:index-active-ingredient');
Route::post('/ingredient', [ActiveIngredientController::class, 'store'])->name('ingredient.store')->middleware('permission:create-active-ingredient');
Route::get('/ingredient/{ingredient}', [ActiveIngredientController::class, 'edit'])->name('ingredient.edit')->middleware('permission:update-active-ingredient');
Route::put('/ingredient/{ingredient}', [ActiveIngredientController::class, 'update'])->name('ingredient.update')->middleware('permission:update-active-ingredient');
Route::delete('/ingredient/{ingredient}', [ActiveIngredientController::class, 'destroy'])->name('ingredient.destroy')->middleware('permission:destroy-active-ingredient');

//Remédios
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicine.index')->middleware('permission:index-medicine');
Route::get('/create-medicines', [MedicineController::class, 'create'])->name('medicine.create')->middleware('permission:create-medicine');
Route::post('/store-medicine', [MedicineController::class, 'store'])->name('medicine.store')->middleware('permission:create-medicine');
// Route::get('/show-medicine/{medicine}', [MedicineController::class, 'show'])->name('medicine.show');
Route::get('/edit-medicine/{medicine}', [MedicineController::class, 'edit'])->name('medicine.edit')->middleware('permission:edit-medicine');
Route::put('/edit-medicine/{medicine}', [MedicineController::class, 'update'])->name('medicine.update')->middleware('permission:edit-medicine');
Route::delete('/medicine/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.destroy')->middleware('permission:destroy-medicine');

//Promoções
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotion.index')->middleware('permission:index-promotions');
Route::get('/create-promotions', [PromotionController::class, 'create'])->name('promotion.create')->middleware('permission:create-promotions');
Route::post('/store-promotion', [PromotionController::class, 'store'])->name('promotion.store')->middleware('permission:create-promotions');
Route::get('/edit-promotion/{promotion}', [PromotionController::class, 'edit'])->name('promotion.edit')->middleware('permission:update-promotions');
Route::put('/edit-promotion/{promotion}', [PromotionController::class, 'update'])->name('promotion.update')->middleware('permission:update-promotions');
Route::delete('/promotion/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy')->middleware('permission:destroy-promotions');

//Estoque
Route::get('/stock', [StockController::class, 'index'])->name('stock.index')->middleware('permission:index-stock');
// Route::get('/create-stock', [StockController::class, 'create'])->name('stock.create');
// Route::post('/store-stock', [StockController::class, 'store'])->name('stock.store');
Route::get('/edit-stock/{stock}', [StockController::class, 'edit'])->name('stock.edit')->middleware('permission:update-stock');
Route::put('/edit-stock/{stock}', [StockController::class, 'update'])->name('stock.update')->middleware('permission:update-stock');
Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy')->middleware('permission:destroy-stock');


//Filais
Route::get('/drugstore', [DrugStoreController::class, 'index'])->name('drugstore.index')->middleware('permission:index-drugstore');
Route::post('/drugstore', [DrugstoreController::class, 'store'])->name('drugstore.store')->middleware('permission:create-drugstore');
Route::put('/drugstore/{drugstore}', [DrugstoreController::class, 'update'])->name('drugstore.update')->middleware('permission:update-drugstore');
Route::delete('/drugstore/{drugstore}', [DrugstoreController::class, 'destroy'])->name('drugstore.destroy')->middleware('permission:destroy-drugstore');


// Vendas
Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
//Orçamentos
Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index')->middleware('permission:index-budget');
// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

});