<?php

use App\Http\Controllers\Api\UrlShortenerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/urls', [UrlShortenerController::class, 'index']);
Route::delete('/urls/{id}', [UrlShortenerController::class, 'destroy']);
