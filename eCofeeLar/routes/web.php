<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Authentification
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par un middleware (à créer) ou gérées dans le constructeur du contrôleur
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/ecoffe', [ProductController::class, 'index'])->name('catalog');
    Route::get('/details/{id}', [ProductController::class, 'show'])->name('details');
    
    Route::get('/panier', [CartController::class, 'index'])->name('cart');
    Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
    Route::post('/panier/incrementer', [CartController::class, 'increment'])->name('cart.inc');
    Route::post('/panier/reduire', [CartController::class, 'decrement'])->name('cart.dec');
    Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/panier/payer', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/panier/payer/verification', [CartController::class, 'processPayment'])->name('cart.processPayment');
});