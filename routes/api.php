<?php

use App\Http\Controllers\Api\UrlShortenerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'urls'], function () {
    Route::get('/', [UrlShortenerController::class, 'index']);
    Route::post('/', [UrlShortenerController::class, 'store']);
    Route::delete('/{id}', [UrlShortenerController::class, 'destroy']);
    Route::get('/{shortenedUrl}', [UrlShortenerController::class, 'redirect']);
});
