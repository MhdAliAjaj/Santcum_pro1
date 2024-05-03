<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});
        
// Route::middleware('auth:sanctum')->group( function () {
//     Route::apiResource('products', ProductController::class);
    
// });

Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
