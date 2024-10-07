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
    /*------------------------------------------------------*/
    /*                    Rotas para Usuário                 */
    /*------------------------------------------------------*/

    Route::prefix('user')->group(function () {
        Route::get('/user', [UserController::class, 'index']);  // Listagem do usuário
        Route::get('/profile', [ProfileController::class, 'show']);  // Mostrar perfil do usuário
        Route::post('/update-profile', [ProfileController::class, 'update']);  // Atualizar perfil do usuário
    });

    /*------------------------------------------------------*/
    /*                   Rotas para Carrinho                 */
    /*------------------------------------------------------*/

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);  // Listar itens do carrinho
        Route::post('/add', [CartController::class, 'add']);  // Adicionar item ao carrinho
        Route::post('/remove', [CartController::class, 'remove']);  // Remover item do carrinho
        Route::post('/clear', [CartController::class, 'clear']);  // Limpar o carrinho
    });

    /*------------------------------------------------------*/
    /*                  Rotas para Pedidos                  */
    /*------------------------------------------------------*/

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);  // Listar pedidos
        Route::get('/{order}', [OrderController::class, 'show']);  // Mostrar pedido específico pelo ID
        Route::post('/create', [OrderController::class, 'create']);  // Criar novo pedido
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);  // Cancelar pedido pelo ID
    });

    /*------------------------------------------------------*/
    /*                  Rotas para Clientes                  */
    /*------------------------------------------------------*/

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);  // Listar clientes
        Route::post('/create', [CustomerController::class, 'store']);  // Criar novo cliente
        Route::post('/{customer}/update', [CustomerController::class, 'update']);  // Atualizar cliente
    });

    /*------------------------------------------------------*/
    /*                 Rotas para Endereços                 */
    /*------------------------------------------------------*/

    Route::prefix('addresses')->group(function () {
        Route::get('/', [AddressController::class, 'index']);  // Listar endereços
        Route::post('/add', [AddressController::class, 'store']);  // Adicionar novo endereço
        Route::post('/{address}/update', [AddressController::class, 'update']);  // Atualizar endereço
        Route::post('/{address}/delete', [AddressController::class, 'destroy']);  // Deletar endereço
    });

    /*------------------------------------------------------*/
    /*                    Rotas para Cartões                 */
    /*------------------------------------------------------*/

    Route::prefix('cards')->group(function () {
        Route::get('/', [CardController::class, 'index']);  // Listar cartões
        Route::post('/add', [CardController::class, 'store']);  // Adicionar novo cartão
        Route::post('/{card}/update', [CardController::class, 'update']);  // Atualizar cartão
        Route::post('/{card}/delete', [CardController::class, 'destroy']);  // Deletar cartão
    });

    /*------------------------------------------------------*/
    /*                Rotas para Métodos de Entrega         */
    /*------------------------------------------------------*/
    
    Route::prefix('delivery-methods')->group(function () {
        Route::get('/', [DeliveryMethodController::class, 'index']);  // Listar métodos de entrega
        Route::post('/select', [DeliveryMethodController::class, 'select']);  // Selecionar método de entrega
    });
});
