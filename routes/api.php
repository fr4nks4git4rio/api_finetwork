<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['checkToken1'])->group(function (){
    Route::post('/recibir_info_facebook', [ApiController::class, 'recibirInfoFacebook']);

    Route::post('/recibir_info_facebook_repsol', [ApiController::class, 'recibirInfoFacebookRepsol']);
});

Route::middleware(['checkToken2'])->group(function (){
    Route::post('/recibir_info_facebook_donsorteo_ifttt', [ApiController::class, 'recibirInfoFacebookDonsorteoIfttt']);
});
