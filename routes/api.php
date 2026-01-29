<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/health-check', function () {
    return response()->json([
        'status' => 'online',
        'message' => 'AtlasLink API is operational'
    ]);
});


Route::post('/assets/sync/{accountId}', [AssetController::class, 'sync']);