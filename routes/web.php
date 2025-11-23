<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/appointment/create', [AppointmentsController::class, 'create'])->name('appointments.create');
Route::get('/payment', [PaymentController::class, 'index'])->name('payments.index');

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

// Especies
Route::get('/species', [SpeciesController::class, 'index'])->name('species.index')->middleware('permission:index-species');
Route::post('/species', [SpeciesController::class, 'store'])->name('species.store')->middleware('permission:create-species');
Route::get('/species/{species}', [SpeciesController::class, 'edit'])->name('species.edit')->middleware('permission:update-species');
Route::put('/species/{species}', [SpeciesController::class, 'update'])->name('species.update')->middleware('permission:update-species');
Route::delete('/species/{species}', [SpeciesController::class, 'destroy'])->name('species.destroy')->middleware('permission:destroy-species');

//Remédios
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('permission:index-products');
Route::get('/create-products', [ProductController::class, 'create'])->name('products.create')->middleware('permission:create-products');
Route::post('/store-product', [ProductController::class, 'store'])->name('products.store')->middleware('permission:create-products');
Route::get('/show-product/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('products.edit')->middleware('permission:edit-products');
Route::put('/edit-product/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('permission:edit-products');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('permission:destroy-products');

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

// Pets
Route::get('/pets', [PetsController::class, 'index'])->name('pets.index');             
Route::get('/pets/create', [PetsController::class, 'create'])->name('pets.create');    
Route::post('/pets', [PetsController::class, 'store'])->name('pets.store');            
Route::get('/pets/{pet}/edit', [PetsController::class, 'edit'])->name('pets.edit');    
Route::put('/pets/{pet}', [PetsController::class, 'update'])->name('pets.update');     
Route::delete('/pets/{pet}', [PetsController::class, 'destroy'])->name('pets.destroy'); 

//Filais
Route::get('/branches', [BranchesController::class, 'index'])->name('branches.index')->middleware('permission:index-branches');
Route::post('/branches', [BranchesController::class, 'store'])->name('branch.store')->middleware('permission:create-branches');
Route::put('/branches/{branch}', [BranchesController::class, 'update'])->name('branch.update')->middleware('permission:update-branches');
Route::delete('/branches/{branch}', [BranchesController::class, 'destroy'])->name('branch.destroy')->middleware('permission:destroy-branches');

Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointment/create', [AppointmentsController::class, 'create'])->name('appointments.create');
Route::post('/appointment/create', [AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/appointment/{appointment}/edit', [AppointmentsController::class, 'edit'])->name('appointments.edit');
Route::put('/appointment/{appointment}', [AppointmentsController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');

Route::get('/pets/create', [PetsController::class, 'create'])->name('pets.create');
Route::get('/payment', [PaymentController::class, 'index'])->name('payments.index');


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