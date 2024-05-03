<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;


Route::controller(RegisterController::class)->group(function(){

    Route::post('register', [RegisterController::class,'register']);
    Route::post('login', [RegisterController::class,'login']);
    
});

//طريقة انشاء راوتات عن طريق غروب
Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [RegisterController::class, 'logout'])->middleware('auth:sanctum');
    Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');

}

);
//طريقة انشاء راوتات عن طريق الطريقةالتقليدية
// Route::post('logout', [RegisterController::class, 'logout'])->middleware('auth:sanctum');
// Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
