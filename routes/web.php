<?php

use App\Http\Controllers\ActiveIngredientController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DrugStoreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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
Route::get('/show-medicine/{medicine}', [MedicineController::class, 'show'])->name('medicine.show');
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
Route::post('/sale', [SaleController::class, 'store'])->name('sale.store');

//Orçamentos
Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index')->middleware('permission:index-budget');
// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

//Papéis
Route::get('/index-role', [RoleController::class, 'index'])->name('role.index')
->middleware('permission:index-role'); //listar os papéis
Route::get('/create-role', [RoleController::class, 'create'])->name('role.create')
->middleware('permission:create-role');
Route::post('/store-role', [RoleController::class, 'store'])->name('role.store')
->middleware('permission:create-role');; //post para salvar creates
Route::get('/edit-role/{role}', [RoleController::class, 'edit'])->name('role.edit')
->middleware('permission:edit-role');
Route::put('/update-role/{role}', [RoleController::class, 'update'])->name('role.update')
->middleware('permission:edit-role'); //put recomendado para atualizar no banco
Route::delete('/destroy-role/{role}', [RoleController::class, 'destroy'])->name('role.destroy')
->middleware('permission:destroy-role'); // delete para apagar registros

//Permissões do papel 
Route::get('/index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index')
->middleware('permission:index-role-permission'); 
Route::get('/update-role-permission/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update')
->middleware('permission:update-role-permission'); 

// Permissões ou páginas
Route::get('/index-permission', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/show-permission/{permission}', [PermissionController::class, 'show'])->name('permission.show');
Route::get('/create-permission', [PermissionController::class, 'create'])->name('permission.create');
Route::post('/store-permission', [PermissionController::class, 'store'])->name('permission.store');
Route::get('/edit-permission/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
Route::put('/update-permission/{permission}', [PermissionController::class, 'update'])->name('permission.update');
Route::delete('/destroy-permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');


});