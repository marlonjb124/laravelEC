<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\OrdenProductoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CartController;


Route::prefix('Products')->group(function () {
    Route::get('', [ProductController::class, 'getProducts']);
    Route::get('Category/{category}', [ProductController::class, 'getProductByCategory']);
    Route::get('Name/{name}', [ProductController::class, 'getProductByName']);
    Route::get('{product_id}', [ProductController::class, 'getProductById']);
    // Route::post('NewProduct', [ProductController::class, 'newProduct']);
    Route::get('obtenerFavoritosUsuario/{userId}', [ProductController::class, 'obtenerFavoritosUsuario']);
   
});




Route::prefix('Cart')->group(function () {
    Route::get('Get/{user_id}', [CartProductController::class, 'getProductsByCartId']);
   
    
});





Route::prefix('Users/Cart')->group(function () {
    Route::get('{user_id}', [CartController::class, 'getCart']);
    Route::post('create', [CartController::class, 'createCart']);
});




Route::prefix('Orden')->group(function () {
    Route::get('MyOrders/{orden_id}', [OrdenProductoController::class, 'searchProductsInOrdenByOrdenId']);
   
});

// routes/api.php o routes/web.php



Route::prefix('Users/Orden')->group(function () {
    Route::post('NewOrden', [OrdenController::class, 'createNewOrden']);
    Route::get('MyOrders/{user_id}', [OrdenController::class, 'searchOrderByUser']);
    Route::delete('/DeleteOrden/{orden_id}', [OrdenController::class, 'deleteOrden']);
    Route::put('CompletarOrden/{ordenId}', [OrdenController::class, 'completarOrden']);
    Route::put('CancelarOrden/{ordenId}', [OrdenController::class, 'cancelarOrden']);

});
// routes/api.php o routes/web.php



Route::prefix('Users/Profile')->group(function () {
    Route::post('Create/{user_id}', [PerfilController::class, 'createProfile']);
    Route::get('{user_id}', [PerfilController::class, 'getProfileData']);
    Route::put('Update/{user_id}', [PerfilController::class, 'updateProfile']);
});

// routes/api.php o routes/web.php


Route::prefix('Users')->group(function () {
    
    Route::post('NewUser', [UserController::class, 'createUser']);
    Route::post('Login', [UserController::class, 'login']);
    Route::get('', [UserController::class, 'getUsers']);
    Route::get('Email/{email}', [UserController::class, 'getUserByEmail']);
    Route::get('name/{username}', [UserController::class, 'getUserByUsername']);
    Route::get('Id/{id}', [UserController::class, 'getUserById']);
   
    // Route::put('AddToFavs', [UserController::class, 'addToFavs']);
    // Route::get('Favs', [UserController::class, 'getFavs']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
// Route::get('/forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/reset-password/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('/reset-password', 'ResetPasswordController@reset');


// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('Me', [UserController::class, 'me']);
    Route::post('favorite', [ProductController::class, 'addToFavorites']);
    Route::delete('favorite', [ProductController::class, 'removeFromFavorites']);
    Route::post('Add', [CartProductController::class, 'addToCart']);
    Route::delete('RemoveProduct/{productId}', [CartProductController::class, 'removeProductFromCart']);
    Route::delete('RemoveProductOrden/{orden_id}/{productId}', [OrdenProductoController::class, 'removeProductFromOrden']);
    Route::put('editarProducto/{productId}', [ProductController::class, 'editarProducto']);
    Route::post('/cambiarContrasena', [PasswordController::class, 'cambiarContrasena']);
    Route::delete('DeleteUser', [UserController::class, 'deleteUser']);
    // Route::post('AddProduct', [OrdenProductoController::class, 'addProductToOrden']);
    // Route::prefix('Users/Profile')->group(function () {
    //     Route::post('Create/{user_id}', [PerfilController::class, 'createProfile']);
    //     Route::get('{user_id}', [PerfilController::class, 'getProfileData']);
    //     Route::put('Update/{user_id}', [PerfilController::class, 'updateProfile']);
    
});
// Route::middleware(['admin'])->group(function () {
//     // ... tus rutas ...
   
// });
// Route::group(['middleware' => ['auth','rol:admin']], function () {

//     Route::post('NewProduct', [ProductController::class, 'newProduct']);
// });
    Route::post('/NewProduct', [ProductController::class, 'newProduct'])
    ->middleware('auth:sanctum', 'rol');