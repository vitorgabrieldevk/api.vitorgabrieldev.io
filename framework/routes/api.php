<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeliveryMethodController;

/*
|--------------------------------------------------------------------------|
| API Routes                                                               |
|--------------------------------------------------------------------------|
*/

Route::middleware(['api.key'])->group(function () {
    // Rotas para gerenciar o usuário
    Route::get('/user', [UserController::class, 'index']);
    
    Route::get('/profile', [ProfileController::class, 'show']);
    
    Route::post('/update-profile', [ProfileController::class, 'update']);

    // Rotas para gerenciar o carrinho
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        
        Route::post('/add', [CartController::class, 'add']);
        
        Route::post('/remove', [CartController::class, 'remove']);
        
        Route::post('/clear', [CartController::class, 'clear']);
    });

    // Rotas para gerenciar pedidos
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        
        Route::get('/{order}', [OrderController::class, 'show']);
        
        Route::post('/create', [OrderController::class, 'create']);
        
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);
    });

    // Rotas para gerenciar clientes
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        
        Route::post('/create', [CustomerController::class, 'store']);
        
        Route::post('/{customer}/update', [CustomerController::class, 'update']);
    });

    // Rotas para gerenciar endereços
    Route::prefix('addresses')->group(function () {
        Route::get('/', [AddressController::class, 'index']);
        
        Route::post('/add', [AddressController::class, 'store']);
        
        Route::post('/{address}/update', [AddressController::class, 'update']);
        
        Route::post('/{address}/delete', [AddressController::class, 'destroy']);
    });

    // Rotas para gerenciar cartões
    Route::prefix('cards')->group(function () {
        Route::get('/', [CardController::class, 'index']);
        
        Route::post('/add', [CardController::class, 'store']);
        
        Route::post('/{card}/update', [CardController::class, 'update']);
        
        Route::post('/{card}/delete', [CardController::class, 'destroy']);
    });

    // Rotas para gerenciar métodos de entrega
    Route::prefix('delivery-methods')->group(function () {
        Route::get('/', [DeliveryMethodController::class, 'index']);
        
        Route::post('/select', [DeliveryMethodController::class, 'select']);
    });
});
