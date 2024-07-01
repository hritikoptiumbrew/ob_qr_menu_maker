<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentModuleController;

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

Route::post('manageAndroidWebhookEvents', [PaymentModuleController::class, 'manageAndroidWebhookEvents']);
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
use App\Http\Controllers\ImageUploadController;

Route::post('upload-image', [ImageUploadController::class, 'uploadImage']);
Route::get('image/{filename}', [ImageUploadController::class, 'getImage']);
