<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderShipController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register' , [UserController::class , 'register'])->name('api.register'); 
Route::post('/login' , [UserController::class , 'login'])->name('api.login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/getUser/{id}' , [Usercontroller::class , 'getUSer'])->name('api.getUser');
    Route::get('/sendMail' , [OrderShipController::class , 'send'])->name('api.send');
});